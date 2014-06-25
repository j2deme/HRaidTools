<?php

$app->get('/raid-designer', function() use($app){
  $data = array();
  $data['networks'] = Network::select('id as value', 'display_name as label')->where('available',true)->get();
  $data['disks'] = Disk::where('available',true)->get();
  $data['distributors'] = Distributor::with('distribution')->get();
  $app->render('raid_designer.twig', $data);
})->name('raid-designer');

$app->get('/workload-generator', function() use($app){
  $data = array();
  $app->render('workload_generator.twig', $data);
})->name('workload-generator');

?>
