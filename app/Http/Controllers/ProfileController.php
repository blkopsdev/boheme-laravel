<?php

namespace App\Http\Controllers;

use App\Media;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

use Str;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name'          => 'required',
            'email'         => 'required',
            'occupation'    => 'required|string|max:255',
            'phone'         => 'required|string|max:255',
            'website_url'   => 'required|string|max:255',
        ];
        
        $this->validate($request, $rules);
        
        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'occupation'    => $request->occupation,
            'phone'         => $request->phone,
            'website_url'   => $request->website_url,
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
        return back()->withStatus(__('app.profile_update_msg'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('app.password_update'));
    }

    public function smtpSetting(Request $request)
    {
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

        auth()->user()->update($data);

        return back()->withStatusSmtp(__('app.smtp_updated'));
    }
}
