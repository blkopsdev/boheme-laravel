<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextFeedback extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file($page_num)
    {
        $file = Media::whereProjectId($this->project_id)->whereType('image')->whereStatusId($this->id)->whereRef('text_feedback')->wherePageNum($page_num)->first();

        return $file;
    }
}
