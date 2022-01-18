<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebDesign extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file($ref)
    {
        $status_id = Status::whereSlug('web_design')->value('id');
        $file = Media::whereProjectId($this->project_id)->whereStatusId($status_id)->whereType('image')->whereRef($ref)->first();
        return $file;
    }
}
