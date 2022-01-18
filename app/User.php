<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* protected $fillable = [
        'name', 'email', 'password',
    ]; */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_admin(){
        if ($this->user_type == 'admin'){
            return true;
        }
        return false;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function todo($id)
    {
        $todo = TodoList::join('calendars', 'todo_lists.calendar_id', '=', 'calendars.id')
        ->where('todo_lists.id', $id)
        ->first();

        return $todo;
    }
}
