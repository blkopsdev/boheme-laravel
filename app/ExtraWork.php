<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraWork extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        $files = Media::whereProjectId($this->project_id)->whereStatusId($this->id)->whereType('image')->whereRef('extra_work')->get();
        
        return $files;
    }
}
