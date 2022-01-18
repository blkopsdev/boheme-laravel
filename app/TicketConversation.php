<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketConversation extends Model
{
    protected $guarded = [];

    public function ticket() 
    {
        return $this->belongsTo(Ticket::class);
    }

    public function name()
    {
        if($this->user_id) {
            $user = User::find($this->user_id);
            return $user->name;
        } else {
            return $this->ticket->name;
        }
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
