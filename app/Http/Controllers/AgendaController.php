<?php

namespace App\Http\Controllers;

use App\AgendaComment;
use App\Project;
use App\Calendar;
use App\TodoList;
use App\Company;
use App\User;
use App\Deadline;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon;

use Response;

class AgendaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function agenda()
    {
        $title = trans('app.agenda');
        $user = auth()->user();
        $calendars = Calendar::whereUserId($user->id)->get();
        $todo_list = TodoList::whereUserId($user->id)->get();
        $users = User::whereCompanyId('1')->get();
        $projects = Project::whereCompanyId('1')->get();
        return view('pages.agenda', compact('title', 'calendars', 'todo_list', 'users', 'projects'));
    }

    public function createCalendar(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'string|required|max:255',
            'bg_color' => 'string|required'
        ];

        $this->validate($request, $rules);

        $data = [
            'name' => $request->name,
            'bg_color' => $request->bg_color,
            'color' => $request->color,
            'user_id' => $user->id,
            'status' => '1'
        ];

        Calendar::create($data);

        return redirect()->back()->with('success', trans('app.calendar_created_msg'));
    }

    public function updateCalendar(Request $request)
    {
        $calendar = Calendar::find($request->id);
        $value = '0';

        if ($request->value == 0) {
            $value = '1';
        } 

        $calendar->update(['status' => $value]);

        return ['success'=>1, 'msg' => trans('app.calendar_update_message')];
    }

    public function editCalendar(Request $request)
    {
        $calendar = Calendar::find($request->id);
        
        $data = [
            'name' => $request->name,
            'bg_color' => $request->bg_color,
            'color' => $request->color,
        ];

        $calendar->update($data);
        return redirect()->back()->with('success', trans('app.calendar_update_message'));
    }

    public function createTodo(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'manager_id' => $request->user,
            'calendar_id' => $request->calendar,
            'project_id' => $request->project,
            'ticket_id' => $request->ticket,
            'user_id' => auth()->user()->id,
            'type' => $request->event_type
        ];

        if ($request->event_type) {
            $data['deadline'] = $request->deadline;
        } else {
            $data['type'] = '0';
            $data['start'] = $request->start;
            $data['end'] = $request->end;
        }

        if ($request->hasFile('files') != Null) {
            
            $files = $request->file('files');
            $file_names = [];
            foreach($files as $file) {
                if($file != Null) {
                    $file_size = fileSizeMB($file->getSize());
                    if ($file_size > 8) {
                        return redirect()->back()->with('error', trans('app.file_size_error_msg'));
                    }
                    $base_name = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
                    $file_name = $base_name . '_' . date('Ymd') . '.' . $file->getClientOriginalExtension();
                    $destinationPath = 'uploads/todo';
                    $file->move($destinationPath, $file_name);
                    array_push($file_names, $file_name);
                } else {
                    array_push($file_names, null);
                }
            }
            $data['files'] = json_encode($file_names);
        }

        TodoList::create($data);

        return redirect()->back()->with('success', trans('app.create_todo_msg'));
    }

    public function showTodo($id)
    {
        $todo = TodoList::find($id);
        // if (auth()->user()->id == $todo->user_id || auth()->user()->id == $todo->manager_id) {
            $comments = AgendaComment::whereTodoListId($id)->get();
            
            return view('pages.show_todo', compact('todo', 'comments'));
        // }
        
        // return redirect()->route('show_todo', $todo->id)->with('error', trans('app.no_permission_edit_todo'));
    }

    public function editTodo($id)
    {
        $todo = TodoList::find($id);
        $calendars = Calendar::whereUserId($todo->user_id)->get();
        $users = User::whereCompanyId('1')->get();
        $projects = Project::whereCompanyId('1')->get();
        return view('pages.edit_todo', compact('todo', 'calendars', 'users', 'projects'));
    }

    public function updateTodo(Request $request, $id)
    {
        $todo = TodoList::find($id);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'manager_id' => $request->user,
            'calendar_id' => $request->calendar,
            'project_id' => $request->project,
            'type' => $request->event_type
        ];

        if ($request->event_type) {
            $data['deadline'] = $request->deadline;
        } else {
            $data['type'] = '0';
            $data['start'] = $request->start;
            $data['end'] = $request->end;
        }

        if ($request->hasFile('files') != Null) {
            
            $files = $request->file('files');
            $file_names = [];
            foreach($files as $file) {
                if($file != Null) {
                    $file_size = fileSizeMB($file->getSize());
                    if ($file_size > 8) {
                        return redirect()->back()->with('error', trans('app.file_size_error_msg'));
                    }
                    $base_name = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
                    $file_name = $base_name . '_' . date('Ymd') . '.' . $file->getClientOriginalExtension();
                    $destinationPath = 'uploads/todo';
                    $file->move($destinationPath, $file_name);
                    array_push($file_names, $file_name);
                } else {
                    array_push($file_names, null);
                }
            }
            $data['files'] = json_encode($file_names);
        }

        $todo->update($data);

        return redirect()->back()->with('success', trans('app.update_todo_msg'));
    }

    public function todoDone(Request $request)
    {
        $id = $request->id;
        $todo = TodoList::find($id);
        $calendar = Calendar::whereUserId($todo->user_id)->whereName('Completed')->first();
        $data = [
            'status' => '1',
            'calendar_id' => $calendar->id
        ];
        if ($todo->status == 1) {
            $data['status'] = '0';
        }
        
        $todo->update($data);
        return redirect()->back()->with('success', trans('app.update_todo_msg'));
    }

    public function indexFullCalendar(Request $request)
    {
        $user = auth()->user();
        if ($request->user) {
            $user = User::find($request->user);
        } 

        $start = $request->startDate ? $request->startDate : '';
        $end = $request->endDate ? $request->endDate : '';

        if(request()->ajax()) 
        {
            $data = [];
            
            $todos = TodoList::Where('manager_id', $user->id)->get();
            $deadlines = Deadline::join('projects', 'deadlines.project_id', '=', 'projects.id')
                ->join('statuses', 'deadlines.status_id', '=', 'statuses.id')
                ->where('projects.user_id', $user->id)
                ->get();

            foreach ($todos as $todo) {
                if ($todo->calendar->status == 1) {
                    $item = [
                        'title' => $todo->name,
                        'textColor' => $todo->calendar->color ? $todo->calendar->color : '',
                        'backgroundColor' => $todo->calendar->bg_color,
                        'editable' => true,
                        'url' => route('show_todo', $todo->id),
                    ];

                    if ($todo->type == 0) {
                        $item['start'] = $todo->start;
                        $item['end'] = $todo->end;
                    } else {
                        $item['start'] = $todo->deadline;
                        $item['allDay'] = true;
                    }

                    array_push($data, $item);
                }
            }

            $d_calendar = Calendar::whereUserId($user->id)->whereName('Deadline')->first();

            if ($d_calendar->status == 1) {
                foreach($deadlines as $deadline) {
                    $deadline_item = [
                        'title' => $deadline->project_name . ' — ' .$deadline->name,
                        'textColor' => $d_calendar->color,
                        'backgroundColor' => $d_calendar->bg_color,
                        'url' => $deadline->space == 0 ? route('website', $deadline->project_id) : route('custom_website', $deadline->project_id),
                        'allDay' => true,
                        'start' => $deadline->deadline
                    ];
                    array_push($data, $deadline_item);
                }
            }

            // -------- Agenda Calendar Date Range Filter ------------ //

            /* $todo_ids = [];
            $nor_query = TodoList::query();
            $ass_nor_query = TodoList::query();
            $allday_query = TodoList::query();
            $ass_allday_query = TodoList::query();
            $deadline_query = Deadline::query();
            $nor_query = $nor_query->whereUserId($user->id)->whereType('0');
            $ass_nor_query = $ass_nor_query->whereManagerId($user->id)->whereType('0');
            $allday_query = $allday_query->whereUserId($user->id)->whereType('1');
            $ass_allday_query = $ass_allday_query->whereManagerId($user->id)->whereType('1');
            if($start != '') {
                $nor_query = $nor_query->whereDate('start', '>=', date('Y-m-d H:i:s', strtotime($start)));
                $ass_nor_query = $ass_nor_query->whereDate('start', '>=', date('Y-m-d H:i:s', strtotime($start)));
                $allday_query = $allday_query->whereDate('deadline', '>=', date('Y-m-d H:i:s', strtotime($start)));
                $ass_allday_query = $ass_allday_query->whereDate('deadline', '>=', date('Y-m-d H:i:s', strtotime($start)));

                $deadline_query = $deadline_query->whereDate('deadlines.deadline', '>=', $start);
            } 
            if($end != '') {
                $nor_query = $nor_query->whereDate('end', '<=', date('Y-m-d H:i:s', strtotime($end)));
                $ass_nor_query = $ass_nor_query->whereDate('end', '<=', date('Y-m-d H:i:s', strtotime($end)));
                $allday_query = $allday_query->whereDate('deadline', '<=', date('Y-m-d H:i:s', strtotime($end)));
                $ass_allday_query = $ass_allday_query->whereDate('deadline', '<=', date('Y-m-d H:i:s', strtotime($end)));
                $deadline_query = $deadline_query->whereDate('deadlines.deadline', '<=', $end);
            } 
            $nor_todos = $nor_query->get();
            $ass_nor_todos = $ass_nor_query->get();
            $allday_todos = $allday_query->get();
            $ass_allday_todos = $ass_allday_query->get();
            $deadlines = $deadline_query->get();
            foreach ($nor_todos as $nor_todo) {
                if ($nor_todo->calendar->status == 1) {
                    $item = [
                        'title' => $nor_todo->name,
                        'textColor' => $nor_todo->calendar->color ? $nor_todo->calendar->color : '',
                        'backgroundColor' => $nor_todo->calendar->bg_color,
                        'editable' => true,
                        'url' => route('show_todo', $nor_todo->id),
                        'start' => $nor_todo->start,
                        'end' => $nor_todo->end,
                    ];
                    array_push($data, $item);
                    array_push($todo_ids, $nor_todo->id);
                }
            }
            foreach ($allday_todos as $allday_todo) {
                if ($allday_todo->calendar->status == 1 && !in_array($allday_todo->id, $todo_ids)) {
                    $item = [
                        'title' => $allday_todo->name,
                        'textColor' => $allday_todo->calendar->color ? $allday_todo->calendar->color : '',
                        'backgroundColor' => $allday_todo->calendar->bg_color,
                        'editable' => true,
                        'url' => route('show_todo', $allday_todo->id),
                        'start' => $allday_todo->deadline,
                        'allDay' => true,
                    ];

                    array_push($data, $item);
                    array_push($todo_ids, $allday_todo->id);
                }
            }
            foreach ($ass_nor_todos as $ass_nor_todo) {
                if ($ass_nor_todo->calendar->status == 1 && !in_array($ass_nor_todo->id, $todo_ids)) {
                    $item = [
                        'title' => $ass_nor_todo->name,
                        'textColor' => $ass_nor_todo->calendar->color ? $ass_nor_todo->calendar->color : '',
                        'backgroundColor' => $ass_nor_todo->calendar->bg_color,
                        'editable' => true,
                        'url' => route('show_todo', $ass_nor_todo->id),
                        'start' => $ass_nor_todo->start,
                        'end' => $ass_nor_todo->end,
                    ];
                    array_push($data, $item);
                    array_push($todo_ids, $ass_nor_todo->id);
                }
            }
            foreach ($ass_allday_todos as $ass_allday_todo) {
                if ($ass_allday_todo->calendar->status == 1 && !in_array($ass_allday_todo->id, $todo_ids)) {
                    $item = [
                        'title' => $ass_allday_todo->name,
                        'textColor' => $ass_allday_todo->calendar->color ? $ass_allday_todo->calendar->color : '',
                        'backgroundColor' => $ass_allday_todo->calendar->bg_color,
                        'editable' => true,
                        'url' => route('show_todo', $ass_allday_todo->id),
                        'start' => $ass_allday_todo->deadline,
                        'allDay' => true,
                    ];
                    
                    array_push($data, $item);
                    array_push($todo_ids, $ass_allday_todo->id);
                }
            } */

            return Response::json($data);
        }
        return false;
    }

    /* public function createFullCalendar(Request $request)
    {  
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Event::insert($insertArr);   
        return Response::json($event);
    }
     
 
    public function updateFullCalendar(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    } 
 
 
    public function destroyFullCalendar(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    } */

    public function destroyCalendar(Request $request)
    {
        $id = $request->id;
        
        $calendar = Calendar::find($id);
        $calendar->delete();

        $todos = TodoList::whereCalendarId($id)->get();

        foreach($todos as $todo) {
            $todo->delete();
        }

        return redirect()->back()->with('success');
    }

    public function destroyTodo(Request $request, $id)
    {
        $todo = TodoList::find($id);
        $todo->delete();

        return redirect()->route('agenda')->with('success', trans('app.todo_remove_msg'));
    }

    public function getCalendar(Request $request)
    {
        $user_id = $request->user_id;
        $calendars = Calendar::whereUserId($user_id)->get();
        return Response::json($calendars);
    }
}
