<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
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

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|email|unique:users',
            'password'  => 'required|string|min:8|confirmed'
        ];
        $this->validate($request, $rules);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::create($data);
        return route('user.index')->withStatus(__('app.user_create_msg'));
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
            'email'     => 'required'
        ];
        $this->validate($request, $rules);
        $user = User::find($id);
        $data = [
            'name'      => $request->name,
            'email'     => $request->email
        ];
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
        $user = User::find($request->id);
        $user->delete();
        return ['success'=>1, 'msg' => trans('app.user_delete_msg')];
    }
}
