<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
