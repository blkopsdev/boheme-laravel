<?php

namespace App\Http\Controllers;

use App\Deadline;
use App\Status;

use Illuminate\Http\Request;

class DeadlineController extends Controller
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
        
        $status = Status::whereSlug($request->status_slug)->first();

        $data = [
            'project_id' => $request->project_id,
            'status_id' => $status->id,
            'status_slug' => $request->status_slug,
            'deadline' => $request->deadline
        ];

        Deadline::create($data);
        return redirect()->back()->with('success', trans('app.deadline_set_msg'));
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
    public function update(Request $request)
    {
        $id = $request->id;
        $deadline = Deadline::find($id);
        $data = $request->deadline;

        $deadline->deadline = $data;
        $deadline->save();

        return ['success' => 1, 'msg' => 'The deadline has been updated successfully.'];
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
