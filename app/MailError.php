<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailError extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
