<?php

namespace App\Http\Controllers;

use App\ErrorMessage;
use App\Project;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('app.add_project');
        return view('dashboards.projects.create ', compact('title'));
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
            'name'          => 'required',
            'company_name'  => 'required',
            'email'         => 'required',
            'phone'         => 'required',
        ];

        $this->validate($request, $rules);
        $available_status = [];
        if ($request->logo_design == 'on') {
            array_push($available_status, 1);
        }
        if ($request->logo_version_1 == 'on') {
            array_push($available_status, 2);
        }
        if ($request->logo_version_2 == 'on') {
            array_push($available_status, 3);
        }
        if ($request->logo_completed == 'on') {
            array_push($available_status, 4);
        }
        if ($request->text_writing == 'on') {
            array_push($available_status, 5);
        }
        if ($request->text_version_1 == 'on') {
            array_push($available_status, 6);
        }
        if ($request->text_version_2 == 'on') {
            array_push($available_status, 7);
        }
        if ($request->text_completed == 'on') {
            array_push($available_status, 8);
        }
        if ($request->first_version == 'on') {
            array_push($available_status, 9);
        }
        if ($request->deliver_text == 'on') {
            array_push($available_status, 10);
        }
        if ($request->first_feedback == 'on') {
            array_push($available_status, 11);
        }
        if ($request->final_feedback == 'on') {
            array_push($available_status, 12);
        }
        if ($request->hosting == 'on') {
            array_push($available_status, 13);
        }

        $available_status = json_encode($available_status);

        $slug = unique_slug($request->name);
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'available_status' => $available_status
        ];

        $create_project = Project::create($data);

        if($create_project) {
            return redirect(route('dashboard'))->with('success', trans('app.project_created_msg'));
        }
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
        $statuses = Status::all();
        $error_messages = ErrorMessage::all();
        $users = User::all();
        $available_status = json_decode($project->available_status);
        return view('dashboards.projects.show', compact('project', 'statuses', 'users', 'error_messages', 'available_status'));
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
        //
    }

    public function updateFields(Request $request, $id)
    {
        $project = Project::find($id);
        $type = $request->type;
        $value = $request->value;
        
        if ($type == 'status') {
            $project->status_id = $value;
            $project->save();
            $status = Status::find($id);
            $status_name = $status->name;
            
            return ['success'=>1, 'msg' => trans('app.status_success_msg', ['status' => $status_name])];
        } elseif ($type == 'error_message') {
            $project->error_id = $value;
            $project->save();
            $error = ErrorMessage::find($id);
            $error_name = $error->message;
            if ($value != Null) {
                return ['success'=>1, 'msg' => trans('app.message_success_msg', ['message' => $error_name])];
                # code...
            } else {
                return ['success'=>1, 'msg' => trans('app.message_disable_msg', ['message' => $error_name])];
            }
        } elseif ($type == 'project_manager') {
            $project->user_id = $value;
            $project->save();
            $user = User::find($id);
            $user_name = $user->name;
            return ['success'=>1, 'msg' => trans('app.project_manager_success_msg', ['name' => $user_name])];
        } elseif ($type == 'is_completed') {
            $project->is_completed = $value;
            $project->save();
            
            return ['success'=>1, 'msg' => trans('app.website_completed_msg')];
        }
        
        return ['success'=>0, 'msg' => trans('app.error_msg')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
