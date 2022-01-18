<?php
/**
 * @return mixed
 * Custom functions made by blkopsdev
 */

require __DIR__.'/laravel_helpers.php';

/**
 * @param string $title
 * @param $model
 * @return string
 */

function media_file($id){
    $file = \App\Media::find($id);

    if(!$file) {
        return false;
    }
    // $file_name = $file;
    return $file;
}

function unique_slug($title = '', $model = 'Project'){
  $slug = str_slug($title);
  //get unique slug...
  $nSlug = $slug;
  $i = 0;

  $model = str_replace(' ','',"\App\ ".$model);
  while( ($model::whereSlug($nSlug)->count()) > 0){
      $i++;
      $nSlug = $slug.'-'.$i;
  }
  if($i > 0) {
      $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
  } else
  {
      $newSlug = $slug;
  }
  return $newSlug;
}

function add_comment($id, $message) {
    $comment = [
        'project_id'    => $id,
        'user_name'     => 'System',
        'message'       => $message
    ];
    $model = \App\Comment::create($comment);

    if (!$model) {
        return false;
    }

    return true;
}

function add_ticket_comment($id, $message) {
    $comment = [
        'ticket_id'    => $id,
        'user_name'     => 'System',
        'message'       => $message
    ];
    $model = \App\TicketComment::create($comment);

    if (!$model) {
        return false;
    }

    return true;
}

function project_action($id, $action) {
    $project = \App\Project::find($id);
    if ($action == 'client') {
        $project->action = '1';
    } elseif ($action == 'company') {
        $project->action = '0';
    }
    $project->save();

    return;
}

function ticket_action($id, $action) {
    $ticket = \App\Ticket::find($id);
    if ($action == 'client') {
        $ticket->action = '1';
    } elseif ($action == 'company') {
        $ticket->action = '0';
    }
    $ticket->save();

    return;
}

function fileSizeMB($size)
{
    if ($size > 0) {
        $size = number_format($size / 1048576,2);
        return $size;
    } else {
        return $size;
    }
}

function countArray($array) {
    if ($array) {
        $data = array_filter($array, "dataFilter");
        $count = count($data);
        return $count;
    }
    return 0;
}

function dataFilter($var){
    return ($var !== NULL && $var !== FALSE && $var !== "");
}