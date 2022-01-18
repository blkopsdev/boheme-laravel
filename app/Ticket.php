<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->hasMany(TodoList::class);
    }

    public function getContent()
    {
        $content = TicketConversation::whereTicketId($this->id)->orderBy('id', 'asc')->limit(1)->get();
        
        return $content[0];
    }
}
