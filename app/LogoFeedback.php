<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogoFeedback extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        $files = Media::whereProjectId($this->project_id)->whereType('image')->whereStatusId($this->id)->whereRef('logo_feedback')->get();
        return $files;
    }

}
