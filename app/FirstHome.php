<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstHome extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        $status_id = Status::whereSlug('first_home')->value('id');

        $files = Media::whereProjectId($this->project_id)->whereStatusId($status_id)->whereType('image')->whereRef('first_home')->get();

        return $files;
    }
}
