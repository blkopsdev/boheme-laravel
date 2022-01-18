<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteTextAdding extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file($ref)
    {
        $status_id = Status::whereSlug('text_adding')->value('id');

        if($ref != 'other_file') {
            $file = Media::whereProjectId($this->project_id)->whereType('image')->whereStatusId($status_id)->whereType('image')->whereRef($ref)->first();
        } else {
            $file = Media::whereProjectId($this->project_id)->whereType('image')->whereStatusId($status_id)->whereType('image')->whereRef($ref)->get();
        }

        return $file;
    }
}
