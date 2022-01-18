<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function logo_file()
    {
        return $this->belongsTo(Media::class, 'logo_name');
    }
}
