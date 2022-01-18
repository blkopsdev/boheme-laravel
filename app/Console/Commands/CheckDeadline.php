<?php

namespace App\Console\Commands;

use App\Deadline;
use App\Project;
use App\Notification;

use Illuminate\Console\Command;

class CheckDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deadline:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Project Deadline';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $date = new \DateTime('tomorrow + 1day');
        $datetime = $date->format('Y-m-d');
        $projects = Project::where('status_id', '!=', '0')->whereIsCompleted('0')->get();
        foreach ($projects as $project) {
            $deadlines = Deadline::whereProjectId($project->id)->where('deadline', '<=', $datetime)->where('deadline', '>=', $today)->get();
            foreach ($deadlines as $deadline) {
                $ex = Notification::whereProjectId($project->id)->whereUserId($project->user_id)->whereStatusId($deadline->status_id)->first();

                $data = [
                    'project_id'    => $project->id,
                    'user_id'       => $project->user_id,
                    'status_id'     => $project->status_id,
                    'quick_view'    => '0',
                    'is_read'       => '0'
                ];
                if (!$ex) {
                    $notification = Notification::create($data); 
                } else {
                    $notification = $ex->update($data);
                }
            }
        }
        return 0;
    }
}
