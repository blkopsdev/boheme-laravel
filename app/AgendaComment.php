<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaComment extends Model
{
    protected $guarded = [];

    public function todo()
    {
        return $this->belongsTo(TodoList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
