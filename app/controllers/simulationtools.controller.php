<?php

$app->get('/raid-designer', function() use($app){
  $data = array();
  $data['networks'] = Network::select('id as value', 'display_name as label')->where('available',false)->get();
  $data['disks'] = Disk::all();
  $app->render('raid_designer.twig', $data);
})->name('raid-designer');

$app->get('/workload-generator', function() use($app){
  $data = array();
  $app->render('workload_generator.twig', $data);
})->name('workload-generator');

?>
