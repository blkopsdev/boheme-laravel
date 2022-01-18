<?php

namespace App\Http\Controllers;

use App\BusinessMail;
use App\Comment;
use App\ContentAdding;
use App\Deadline;
use App\ErrorMessage;
use App\ExtraWork;
use App\ExtraFunction;
use App\FirstFeedback;
use App\FinalFeedback;
use App\Hosting;
use App\LogoCompleted;
use App\LogoDesignForm;
use App\LogoFirstFeedback;
use App\LogoFinalFeedback;
use App\MailError;
use App\Media;
use App\Project;
use App\Reseller;
use App\Status;
use App\TextWriting;
use App\TextFirstFeedback;
use App\TextFinalFeedback;
use App\TextCompleted;
use App\User;
use App\WebshopOnboarding;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class WebShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('app.webshops');
        $projects = Project::whereSpace(3)->orderBy('created_at', 'desc')->get();
        
        $users = User::orderBy('name', 'asc')->get();
        return view('dashboard.webshops.index', compact('title', 'projects', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('app.add_project');
        $resellers = Reseller::get();
        return view('dashboard.webshops.create', compact('title', 'resellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'project_name'  => 'required',
            'name'          => 'required',
            'company_name'  => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ];

        $this->validate($request, $rules);
        $status = $request->status;

        array_push($status, 'afgerond', 'review');
        $available_status = json_encode($status);

        $slug = unique_slug($request->name);
        $data = [
            'project_name' => $request->project_name,
            'name' => $request->name,
            'slug' => $slug,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'available_status' => $available_status,
            'space' => 3,
            'note'  => $request->note,
            'reseller_id' => $request->reseller,
            'company_id' => auth()->user()->company_id
        ];

        $project = Project::create($data);

        if(!$project) {
            return redirect(route('dashboard'))->with('error', trans('app.project_error_msg'));
        }

        add_comment($project->id, trans('app.project_created_msg'));

        return redirect()->route('webshop.index')->with('success', trans('app.project_created_msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        
        $files = Media::whereProjectId($id)->whereType('image')->get();
        $statuses = Status::all();
        $error_messages = ErrorMessage::all();
        $users = User::all();
        $available_status = json_decode($project->available_status);
        $comments = Comment::whereProjectId($id)->whereType('1')->orderBy('id')->get();
        $media = Media::whereProjectId($id)->whereType('file')->whereRef('manual_logo')->get();
        return view('dashboard.webshops.show', compact('project', 'statuses', 'users', 'error_messages', 'available_status', 'comments', 'media', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = trans('app.edit_project');
        $project = Project::find($id);
        $resellers = Reseller::get();
        return view('dashboard.webshops.edit', compact('title', 'project', 'resellers'));
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
        $rules = [
            'project_name'  => 'required',
            'name'          => 'required',
            'company_name'  => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ];

        $this->validate($request, $rules);

        $status = $request->status;

        array_push($status, 'afgerond', 'review');
        $available_status = json_encode($status);

        $slug = unique_slug($request->name);

        $data = [
            'project_name' => $request->project_name,
            'name' => $request->name,
            'slug' => $slug,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note'  => $request->note,
            'reseller_id' => $request->reseller,
            'available_status' => $available_status
        ];

        $project = Project::find($id);
        $update = $project->update($data);

        if(!$update) {
            return redirect()->back()->with('error', trans('app.project_error_msg'));
        }

        add_comment($project->id, trans('app.project_update_msg'));

        return redirect()->route('webshop.show', $project->id)->with('success', trans('app.project_update_msg'));
    }
}
