<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;

use App\Mail\Welcome;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        $project_id = $request->project_id;
        $user_id = $request->user_id;
        $project = Project::find($project_id);
        $user = User::find($user_id);
        Mail::to($project->email)->send(new Welcome($project, $user));

        $project->sent_welcome = '1';
        $project->save();
        return ['success'=>1, 'msg' => trans('app.success_welcome_mail')];
    }
}
