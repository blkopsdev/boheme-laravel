<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogoDesignForm extends Model
{
    protected $guarded = [];

    public function project() {
        return $this->belongsTo(Project::class);
    }

}
