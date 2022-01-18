<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $guarded = [];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function manager()
    {
        $id = $this->manager_id;
        $manager = User::find($id);
        return $manager;
    }

    public function scopeWithCategory($query)
    {
        return $query->with('category')->where('status', 'published');
    }
}
