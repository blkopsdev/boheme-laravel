<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalFeedback extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files($page_num)
    {
        $files = Media::whereProjectId($this->project_id)->whereRef('final_feedback')->wherePageNum($page_num)->get();

        return $files;
    }
}
