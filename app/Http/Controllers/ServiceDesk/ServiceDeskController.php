<?php

namespace App\Http\Controllers\ServiceDesk;

use App\Http\Controllers\Controller;

use App\Media;
use App\Project;
use App\Company;
use App\User;
use App\Ticket;
use App\TicketComment;
use App\TicketConversation;
use App\TodoList;

use App\Mail\TicketCreateEmail;
use App\Mail\TicketMessageFromAdminEmail;
use App\Mail\TicketMessageFromClientMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('app.open_tickets');
        $tickets = Ticket::where('action', '!=', '3')->orderBy('created_at', 'desc')->get();
        $activePage = 'open_tickets';
        $users = User::orderBy('name', 'asc')->get();
        return view('service-desk.back-end.index', compact('title', 'tickets', 'users', 'activePage'));
    }

    public function closedIndex()
    {
        $title = trans('app.closed_tickets');
        $tickets = Ticket::whereAction('3')->orderBy('created_at', 'desc')->get();
        
        $activePage = 'closed_tickets';
        $users = User::orderBy('name', 'asc')->get();
        return view('service-desk.back-end.index', compact('title', 'tickets', 'users', 'activePage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('app.create_ticket');

        return view('service-desk.back-end.create', compact('title'));

    }

    public function frontCreate()
    {
        $title = trans('app.submit_ticket');
        
        return view('service-desk.front-end.create', compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'company_name' => $request->company_name,
            'phone'     => $request->phone,
            'email' => $request->email,
            'priority' => $request->priority,
            'token' => str_random(36)
        ];

        $ticket = Ticket::create($data);
        
        if(!$ticket) {
            return redirect(route('service_desk'))->with('error', trans('app.ticket_error_msg'));
        }

        add_ticket_comment($ticket->id, trans('app.ticket_created_msg'));

        $message = [
            'subject' => $request->subject,
            'note' => $request->note,
            'user_id'   => auth()->user()->id,
            'ticket_id' => $ticket->id
        ];

        if ($request->File('file') != Null) {
            $file = $request->file('file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            $media = Media::create(['media_name'=>$file_name, 'type'=>'file', 'ref'=>'ticket']);
            $destinationPath = 'uploads/ticket/';
            $file->move($destinationPath, $file_name);

            $message['media_id'] = $media->id;
        }

        TicketConversation::create($message);

        return redirect(route('service_desk'))->with('success', trans('app.ticket_created_msg'));
    }

    public function frontStore(Request $request)
    {
        
        $data = [
            'name' => $request->name,
            'company_name' => $request->company_name,
            'phone'     => $request->phone,
            'email' => $request->email,
            'priority' => $request->priority,
            'token' => str_random(36)
        ];

        $ticket = Ticket::create($data);
        
        if(!$ticket) {
            return redirect(route('service_desk'))->with('error', trans('app.ticket_error_msg'));
        }

        add_ticket_comment($ticket->id, trans('app.ticket_created_msg'));

        $message = [
            'subject' => $request->subject,
            'note' => $request->note,
            'ticket_id' => $ticket->id
        ];

        if ($request->File('file') != Null) {
            $file = $request->file('file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            $media = Media::create(['media_name'=>$file_name, 'type'=>'file', 'ref'=>'ticket']);
            $destinationPath = 'uploads/ticket/';
            $file->move($destinationPath, $file_name);

            $message['media_id'] = $media->id;
        }

        TicketConversation::create($message);

        Mail::to($ticket->email)->send(new TicketMessageFromClientMail($ticket));
        $support_email = Company::find(1)->value('sd_email');
        if (!$support_email) {
            $support_email = 'info@iqscript.nl';
        }
        Mail::to($support_email)->send(new TicketCreateEmail($ticket));

        return redirect(route('add_ticket'))->with('success', trans('app.ticket_created_msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $users = User::all();
        $conversations = TicketConversation::whereTicketId($id)->get();
        $comments = TicketComment::whereTicketId($id)->orderBy('id')->get();

        if ($ticket->action == 3) { 
            $activePage = 'closed_tickets';
        } else {
            $activePage = 'open_tickets';
        }
        return view('service-desk.back-end.show', compact('ticket', 'users', 'conversations', 'activePage', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket['user_id'] = $request->value;
        $ticket->update();

        return ['success'=>1, 'msg' => trans('app.ticket_update_msg')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->route('service_desk')->with('success', trans('app.ticket_remove_msg'));
    }

    public function updateTicketAction(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->action = $request->value;
        if ($request->value == 3) {
            $ticket['status'] = 1;
        }
        $ticket->update();
        return ['success' => 1, 'ticket' => $ticket];
    }

    public function ticketStatus(Request $request)
    {
        $id = $request->id;
        $ticket = Ticket::find($id);
        
        if ($ticket->status == 1) {
            $ticket['status'] = '0';
        } else {
            $ticket['status'] = '1';
            $ticket['action'] = '3';
        }
        
        $ticket->update();
        return redirect()->back()->with('success', trans('app.update_ticket_msg'));
    }

    public function closeTicket(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        
        $ticket['status'] = '1';
        $ticket['action'] = '3';
        
        $ticket->update();
        return redirect()->back()->with('success', trans('app.update_ticket_msg'));
    }

    public function frontShow($id, Request $request)
    {
        $ticket = Ticket::find($id);
        if ($ticket->token != $request->token) {
            return abort(404);
        }
        
        $conversations = TicketConversation::whereTicketId($id)->get();

        return view("service-desk.front-end.show", compact('ticket', 'conversations'));
    }

    public function commentUpdate($id, Request $request)
    {
        $data = [
            'ticket_id'    => $id,
            'user_name'     => auth()->user()->name,
            'message'       => $request->comment,
            'type'          => '1'
        ];
        $comment = TicketComment::create($data);
        if ($comment) {
            return ['success'=>1, 'id' => $comment->id ];
        }
        return ['success'=>0, 'msg' => trans('app.error_msg')];
    }

    public function addMessage(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $data = [
            'subject' => $request->subject,
            'note' => $request->note,
            'ticket_id' => $id,
            'user_id' => auth()->check() ? auth()->user()->id : 0
        ];

        if ($request->File('file') != Null) {
            $file = $request->file('file');
            
            $file_base_name = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());

            $file_name = $file_base_name . \mt_rand(0,20000) . '.' . $file->getClientOriginalExtension();
            $media = Media::create(['media_name'=>$file_name, 'type'=>'file', 'ref'=>'ticket']);
            $destinationPath = 'uploads/ticket/';
            $file->move($destinationPath, $file_name);

            $data['media_id'] = $media->id;
        }

        $conversation = TicketConversation::create($data);

        if(!$conversation) {
            return redirect()->back()->with('error', trans('app.error_msg'));
        }

        if (auth()->check()) {
            Mail::to($ticket->email)->send(new TicketMessageFromAdminEmail($ticket));
            $action = 'client';
        } else {
            $action = 'company';
            Mail::to($ticket->email)->send(new TicketMessageFromClientMail($ticket));
            $ticket['status'] = '0';
            $ticket->update();
        }

        ticket_action($ticket->id, 'client');

        return redirect()->back()->with('success', trans('app.message_sent_msg'));
    }
}
