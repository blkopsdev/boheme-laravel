<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;
use Carbon\Carbon;
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
        $title = "Dashboard";
        $customers = Customer::get();
        $transactions = Transaction::get();
        $today_transactions = Transaction::whereDate('created_at', Carbon::today())->get();
        $new_trans = Transaction::latest()->take(5)->get();
        // $projects = Project::get();
        return view('dashboard', compact('title', 'customers', 'transactions', 'today_transactions', 'new_trans'));
    }
}
