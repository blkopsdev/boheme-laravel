<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextFinalFeedback extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file($page_num)
    {
        $file = Media::whereProjectId($this->project_id)->whereType('image')->whereRef('text_version_2')->wherePageNum($page_num)->first();

        return $file;
    }
}
