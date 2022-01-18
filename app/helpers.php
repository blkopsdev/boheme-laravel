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