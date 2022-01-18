<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraFunction extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function file($page_num)
    {
        $file = Media::whereProjectId($this->project_id)->whereRef('extra_function')->wherePageNum($page_num)->first();

        return $file;
    }
}
