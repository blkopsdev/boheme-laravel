<?php

namespace App\Http\Controllers;

use App\Project;
use App\Calendar;
use App\TodoList;
use App\Company;
use App\User;
use App\Media;

use Illuminate\Support\Facades\Validator;
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
        $projects = Project::whereSpace(1)->orderBy('created_at', 'desc')->get();
        
        $users = User::orderBy('name', 'asc')->get();
        return view('dashboard.projects.index', compact('title', 'projects', 'users'));
    }

    public function settings()
    {
        $title = trans('app.theme_settings');
        $company = Company::find('1');
        return view('pages.settings', compact('title', 'company'));
    }

    public function updateSettings(Request $request)
    {
        $company = Company::find('1');

        $data = [
            'company_name' => $request->company_name,
            'main_color' => $request->main_color,
            'sub_color' => $request->sub_color,
            'other_color' => $request->other_color,
            'smtp_host' => $request->smtp_host,
            'smtp_port' => $request->smtp_port,
            'smtp_username' => $request->smtp_username,
            'smtp_password' => $request->smtp_password,
            'smtp_encryption' => $request->smtp_encryption,
            'sd_email' => $request->sd_email
        ];

        if ($request->hasFile('logo') != Null) {
            $file = $request->file('logo');
            $file_size = fileSizeMB($file->getSize());
            
            $base_name = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
            $file_name = $request->company_name . '_logo' . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = 'uploads/companies/';
            $file->move($destinationPath, $file_name);
            
            $data['logo'] = $destinationPath . $file_name;
        }

        $company = $company->update($data);

        return redirect()->back()->with('success', trans('app.settings_updated'));
    }
}
