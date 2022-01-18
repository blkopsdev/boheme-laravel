<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebdesignOnboarding extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file($ref)
    {
        $status_id = Status::whereSlug('webdesign_onboarding')->value('id');
        $file = Media::whereProjectId($this->project_id)->whereStatusId($status_id)->whereType('image')->whereRef($ref)->first();
        return $file;
    }
}
