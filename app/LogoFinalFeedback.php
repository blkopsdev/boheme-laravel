<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogoFinalFeedback extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        $status_id = Status::whereSlug('logo_version_2')->value('id');
        $files = Media::whereProjectId($this->project_id)->whereType('image')->whereStatusId($status_id)->whereRef('logo_version_2')->get();
        return $files;
    }

    public function logo_file()
    {
        $status_id = Status::whereSlug('logo_version_2')->value('id');
        $file = Media::whereProjectId($this->project_id)->whereType('file')->whereStatusId($status_id)->whereRef('manual_logo')->orderBy('id', 'desc')->first();

        return $file;
    }
}
