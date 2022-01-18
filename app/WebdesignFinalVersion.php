<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebdesignFinalVersion extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        $status_id = Status::whereSlug('webdesign_version_2')->value('id');

        $files = Media::whereProjectId($this->project_id)->whereStatusId($status_id)->whereType('image')->whereRef('webdesign_version_2')->get();

        return $files;
    }
}
