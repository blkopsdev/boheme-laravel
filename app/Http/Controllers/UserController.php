<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Media;
use App\Notification;
use App\User;

use Str;
use Image;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function show($id)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|max:255|email|unique:users',
            'occupation'    => 'required|string|max:255',
            'phone'         => 'required|string|max:255',
            'image'         => 'required',
            'website_url'   => 'required|string|max:255',
            'password'      => 'required|string|min:8|confirmed',
        ];
        $this->validate($request, $rules);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'occupation' => $request->occupation,
            'phone' => $request->phone,
            'user_type' => $request->user_type,
            'website_url' => $request->website_url,
            'password' => Hash::make($request->password),
            'company_id' => '1'
        ];

        $image = $request->file('image');
        $data['image_name'] = time().'.'.$image->extension();
    
        $destinationPath = public_path('/uploads/users');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$data['image_name']);

        $user = User::create($data);

        // Create default calendars for Agenda

        $calendars = [
            [
                'name' => 'Deadline',
                'user_id' => $user->id,
                'status' => '1',
                'bg_color' => '#7B68EE',
                'type' => '1'
            ],
            [
                'name' => 'Completed',
                'user_id' => $user->id,
                'status' => '1',
                'bg_color' => '#7BC831',
                'type' => '1'
            ]
        ];
        foreach ($calendars as $calendar) {
            Calendar::create($calendar);
        }
        
        return redirect(route('show_users'))->with('success', trans('app.user_create_msg'));
    }
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'occupation'    => 'required|string|max:255',
            'phone'         => 'required|string|max:255',
            'website_url'   => 'required|string|max:255',
        ];
        
        $this->validate($request, $rules);
        $user = User::find($id);
        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'occupation' => $request->occupation,
            'user_type' => $request->user_type,
            'phone' => $request->phone,
            'website_url' => $request->website_url
        ];

        if($request->File('image') != null) {
            $image = $request->file('image');
            $data['image_name'] = time().'.'.$image->extension();
        
            $destinationPath = public_path('/uploads/users');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$data['image_name']);
        }

        $user->update($data);
        return back()->withStatus(__('app.user_update_msg'));
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    
    public function updatePassword(PasswordRequest $request, $id)
    {
        $user = User::find($id);
        $user->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('app.password_update'));
    }

    public function destroy(Request $request) {
        $user = User::find($request->user_id);
        $user->delete();
        return ['success'=>1, 'msg' => trans('app.user_delete_msg')];
    }

    public function notifications()
    {
        $user = Auth::user();
        $data = Notification::whereUserId($user->id)->orderBy('updated_at', 'desc')->get();

        return view('pages.notifications', compact('data'));
    }

    public function NotificationQuickUpdate(Request $request)
    {
        $user_id = $request->id;
        $data = Notification::whereUserId($user_id)->get();
        if($data) {
            foreach ($data as $item) {
                $item->quick_view = '1';
                $item->save();
            }

            return ['success'=>1];
        } else {
            return ['success'=> 0];
        }
    }

    public function NotificationRead(Request $request)
    {
        $id = $request->id;
        $notification = Notification::find($id);
        
        $notification->is_read = '1';
        $notification->save();

        return ['success' => 1];
    }

    public function NotificationDelete(Request $request)
    {
        $id = $request->id;
        $notification = Notification::find($id);
        
        if($notification) {
            $notification->delete();

            $user = Auth::user();
            $notifies = Notification::whereUserId($user->id)->get();
            if($notifies->count() == 0) {
                $notifies = 0;
            } else {
                $notifies = 1;
            }
            
            return ['success' => 1, 'notifies' => $notifies];
        }

        return ['success' => 0];

    }

    public function smtpSetting(Request $request, $id)
    {
        $user = User::find($id);

        $rules = [
            'smtp_host' => 'required|string|max:255',
            'smtp_port' => 'required|string|max:255',
            'smtp_username' => 'required|string|max:255',
            'smtp_password' => 'required|string|max:255',
            'smtp_encryption' => 'required|string|max:255',
        ];

        $this->validate($request, $rules);

        $data = [
            'smtp_host' => $request->smtp_host,
            'smtp_port' => $request->smtp_port,
            'smtp_username' => $request->smtp_username,
            'smtp_password' => $request->smtp_password,
            'smtp_encryption' => $request->smtp_encryption,
            'confirm_smtp' => $request->smtp_confirm
        ];

        $user->update($data);

        return back()->withStatusSmtp(__('app.smtp_updated'));
    }
}
