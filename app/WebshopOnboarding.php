<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebshopOnboarding extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file()
    {
        $status_id = Status::whereSlug('webshop_onboarding')->value('id');
        $file = Media::whereProjectId($this->project_id)->whereStatusId($status_id)->whereType('image')->whereRef('webshop_onboarding')->first();
        
        return $file;
    }
}
