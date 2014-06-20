<?php

$app->get('/raid-designer', function () use ($app){
  $data = array();
  $data['networks'] = Network::select('id as value', 'display_name as label')->get();
  $data['disks'] = Disk::all();
  $app->render('testing2.twig',$data);
})->name('raid-designer');

?>
