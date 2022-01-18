<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Project;
use App\AgendaComment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        //
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
            'id'        => 'required',
            'comment'   => 'required',
        ];
        $this->validate($request, $rules);

        $user = Auth::user();
        $data = [
            'project_id'    => $request->id,
            'user_name'     => $user->name,
            'message'       => $request->comment,
            'type'          => '1'
        ];
        $comment = Comment::create($data);
        if ($comment) {
            return ['success'=>1, 'id' => $comment->id ];
        }
        return ['success'=>0, 'msg' => trans('app.error_msg')];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            return ['success'=>1];
        }

        return ['success'=>0, 'msg' => trans('app.error_msg')];

    }

    public function getAll($id)
    {
        $comments = Comment::whereProjectId($id)->get();
        $content = '';
        foreach($comments as $comment) {
            $content .= '<div class="comments-item"><div class="comment_image"><i class="material-icons" style="font-size: 50px; color:' . auth()->user()->company->main_color . ';">account_circle</i></div><div class="comments-context"><h4><strong>' . $comment->user_name . '</strong> <span class="comment-time">' . date('d-m-Y H:i',strtotime($comment->created_at)) . '</span></h4><p>' . $comment->message . ' <button class="btn btn-danger comment_delete" data-id="' . $comment->id . '"><span><i class="fa fa-trash"></i> </span></button></p></div></div>';
        }

        return $content;

    }

    public function getUser($id)
    {
        $comments = Comment::whereProjectId($id)->whereType('1')->get();
        $content = '';
        foreach($comments as $comment) {
            $content .= '<div class="comments-item"><div class="comment_image"><img src="' . asset("assets/img/profile_logo.png") . '" class="img-fluid"></div><div class="comments-context"><h4><strong>' . $comment->user_name . '</strong> <span class="comment-time">' . date('d-m-Y H:i',strtotime($comment->created_at)) . '</span></h4><p>' . $comment->message . ' <button class="btn btn-danger comment_delete" data-id="' . $comment->id . '"><span><i class="fa fa-trash"></i> </span></button></p></div></div>';
        }

        return $content;

    }

    public function storeAgendaComment(Request $request)
    {
        $rules = [
            'id'        => 'required',
            'comment'   => 'required',
        ];
        $this->validate($request, $rules);

        $user = Auth::user();
        $data = [
            'todo_list_id'    => $request->id,
            'user_id'       => $user->id,
            'message'       => $request->comment,
        ];
        $comment = AgendaComment::create($data);
        if ($comment) {
            return ['success'=>1, 'id' => $comment->id ];
        }
        return ['success'=>0, 'msg' => trans('app.error_msg')];
    }

    public function destroyAgendaComment(Request $request)
    {
        $id = $request->id;
        $comment = AgendaComment::find($id);
        if ($comment) {
            $comment->delete();
            return ['success'=>1];
        }

        return ['success'=>0, 'msg' => trans('app.error_msg')];

    }
}
