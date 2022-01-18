<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessMail extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
