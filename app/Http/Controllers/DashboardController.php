<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = trans('app.websites');
        $projects = Project::get();
        return view('dashboards.index', compact('title', 'projects'));
    }
}
