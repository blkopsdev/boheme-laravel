<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstFeedback extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files($page_num)
    {
        $files = Media::whereProjectId($this->project_id)->whereRef('first_feedback')->wherePageNum($page_num)->get();

        return $files;
    }
}
