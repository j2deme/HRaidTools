<?php

 $app->get('/testing_index', function () use($app){
    $data = array();
    $app->render('testing_index.twig', $data);
  })->name('t_index');

  $app->get('/testing_papers', function () use($app){
    $data = array();
    $app->render('testing_papers.twig', $data);
  })->name('t_papers');

  $app->get('/testing_staff', function () use($app){
    $data = array();
    $app->render('testing_staff.twig', $data);
  })->name('t_staff');

  $app->get('/testing_about', function () use($app){
    $data = array();
    $app->render('testing_about.twig', $data);
  })->name('t_about');

  $app->get('/testing2', function () use($app){
    $data = array();
    $data['networks'] = Network::select('id as value', 'display_name as label')->get();
    $app->render('testing2.twig', $data);
  })->name('testing2');

  $app->get('/testing3', function () use($app){
    $data = array();
    $app->render('testing3.twig', $data);
  })->name('testing3');

 $app->get('/testing', function () use($app){
    $data = array();
    $app->render('testing.twig', $data);
  })->name('testing');

 $app->get('/testing_disks', function () use($app){
    $data = array();
    $data['unit'] = array('KB','MB','GB','TB', 'PB');
    $app->render('testing_disks.twig', $data);
  })->name('testing_disks');

$app->post('/add_disks', function () use($app){
  $post = (object) $app->request->post();
  $disk = new Disk();
  $disk->name = $post->name;
  $disk->type = $post->type;
  $disk->sector = $post->sector;
  $disk->sector_track = $post->sector_track;
  $disk->track_cylinder = $post->track_cylinder;
  $disk->cylinders = $post->cylinders;
  $disk->rpm = $post->rpm;
  $disk->track_overhead = $post->track_overhead;
  $disk->track_skew = $post->track_skew;
  $disk->cylinder_skew = $post->cylinder_skew;
  $disk->limit_disk = $post->limit_disk;
  $disk->short_disk = $post->short_disk;
  $disk->long_disk = $post->long_disk;
  $disk->regions = $post->regions;
  $disk->manufacturer = $post->manufacturer;
  $disk->product_name = $post->product_name;
  $disk->display_name = $post->display_name;
  $disk->display_size = $post->display_size;
  $disk->display_unit = $post->display_unit;
  $disk->available = (isset($post->available)) ? $post->available : false;
  $disk->save();
  $app->redirect($app->urlFor('root'));
})->name('add_disks');

$app->get('/testing_controllers', function () use($app){
  $data = array();
  $app->render('testing_controllers.twig', $data);
})->name('testing_controllers');

$app->post('/add_controllers', function () use($app){
  $post = (object) $app->request->post();
  $controller = new Controller();
  $controller->name = $post->name;
  $controller->type = $post->type;
  $controller->block_size = $post->block_size;
  $controller->cache_size = $post->cache_size;
  $controller->new_overhead = $post->new_overhead;
  $controller->read_fence = $post->read_fence;
  $controller->write_fence = $post->write_fence;
  $controller->prefetching = $post->prefetching;
  $controller->inmediate_report = $post->inmediate_report;
  $controller->msg_size = $post->msg_size;
  $controller->available = (isset($post->available)) ? $post->available : false;
  $controller->save();
  $app->redirect($app->urlFor('root'));
})->name('add_controllers');

$app->get('/testing_drives', function () use($app){
  $data = array();
  $data['controller'] = Controller::select('id as value', 'name as label')->get();
  $data['disk'] = Disk::select('id as value', 'name as label')->get();
  $app->render('testing_drives.twig', $data);
})->name('testing_drives');

$app->post('/add_drives', function () use($app){
  $post = (object) $app->request->post();
  $drive = new Drive();
  $drive->name = $post->name;
  $drive->controller_id = $post->controller_id;
  $drive->disk_id = $post->disk_id;
  $drive->available = (isset($post->available)) ? $post->available : false;
  $drive->save();
  $app->redirect($app->urlFor('root'));
})->name('add_drives');

$app->get('/testing_networks', function () use($app){
  $data = array();
  $app->render('testing_networks.twig', $data);
})->name('testing_networks');

$app->post('/add_networks', function () use($app){
  $post = (object) $app->request->post();
  $network = new Network();
  $network->type = $post->type;
  $network->latency = $post->latency;
  $network->bandwidth = $post->bandwidth;
  $network->network = $post->network;
  $network->display_name = $post->display_name;
  $network->display_order = $post->display_order;
  $network->available = (isset($post->available)) ? $post->available : false;
  $network->save();
  $app->redirect($app->urlFor('root'));
})->name('add_networks');

$app->get('/testing_distributions', function () use($app){
  $data = array();
  $app->render('testing_distributions.twig', $data);
})->name('testing_distributions');

$app->post('/add_distributions', function() use($app){
  $post = (object) $app->request->post();
  $distribution = new Distribution();
  $distribution->name = $post->name;
  $distribution->display_order = $post->display_order;
  $distribution->is_trace_generator = (isset($post->is_trace_generator)) ? $post->is_trace_generator : false;
  $distribution->available = (isset($post->available)) ? $post->available : false;
  $distribution->save();
  $app->redirect($app->urlFor('root'));
})->name('add_distributions');

$app->get('/testing_distributors', function () use($app){
  $data = array();
  $data['distributions'] = Distribution::select('id as value', 'name as label')->get();
  $app->render('testing_distributors.twig', $data);
})->name('testing_distributors');

$app->post('/add_distributors', function () use($app){
  $post = (object) $app->request->post();
  $distributor = new Distributor();
  $distributor->distributor = $post->distributor;
  $distributor->type = $post->type;
  $distributor->size = $post->size;
  $distributor->striping = $post->striping;
  $distributor->overhead = $post->overhead;
  $distributor->max_requests = $post->max_requests;
  $distributor->report = (isset($post->available)) ? $post->available : false;
  $distributor->done_size = $post->done_size;
  $distributor->display_name = $post->display_name;
  $distributor->display_order = $post->display_order;
  $distributor->distribution_id = $post->distribution_id;
  $distributor->available = (isset($post->available)) ? $post->available : false;
  $distributor->save();
  $app->redirect($app->urlFor('root'));
})->name('add_distributors');

?>
