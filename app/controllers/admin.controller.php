<?php

$app->get('/admin', function () use($app){
  $data = array();
  $app->render('admin.twig', $data);
})->name('admin');

$app->get('/disks', function () use($app){
  $app->render('view_disks.twig');
})->name('disks');

$app->get('/disks.json', function() use($app){
    $disks = Disk::all();
    echo $disks->toJson();
});

$app->get('/new_disk', function () use($app){
  $data = array();
  $data['unit'] = array('KB','MB','GB','TB', 'PB');
  $app->render('add_disks.twig', $data);
})->name('new_disk');

$app->post('/new_disk', function () use($app){
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
  $app->redirect($app->urlFor('disks'));
})->name('add_disk');

$app->get('/controllers', function() use($app){
  $app->render('view_controllers.twig');
})->name('controllers');

$app->get('/controllers.json', function() use($app){
    $controllers = Controller::all();
    echo $controllers->toJson();
});

$app->get('/new_controller', function () use($app){
  $data = array();
  $app->render('add_controllers.twig', $data);
})->name('new_controller');

$app->post('/new_controller', function () use($app){
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
  $app->redirect($app->urlFor('controllers'));
})->name('add_controller');

$app->get('/drives', function() use($app){
  $app->render('view_drives.twig');
})->name('drives');

$app->get('/drives.json', function() use($app){
  $drives = Drive::with('disk','controller')->get();
  for ($i=0; $i < $drives->count(); $i++) {
      $drives[$i]->controller_name = $drives[$i]->controller->name;
      $drives[$i]->disk_name = $drives[$i]->disk->name;
    }
    echo $drives->toJson();
});

$app->get('/new_drive', function () use($app){
  $data = array();
  $data['controller'] = Controller::select('id as value', 'name as label')->get();
  $data['disk'] = Disk::select('id as value', 'name as label')->get();
  $app->render('add_drives.twig', $data);
})->name('new_drive');

$app->get('/views_c/:id', function($id) use($app){
  $isAjax = $app->request()->isAjax();
  if($isAjax){
    $data['c'] = Controller::where('id',$id)->first();
    echo $data['c']->toJson();
  }
});

$app->get('/views_d/:id', function($id) use($app){
  $isAjax = $app->request()->isAjax();
  if($isAjax){
    $data['d'] = Disk::where('id',$id)->first();
    echo $data['d']->toJson();
  }
});

$app->post('/add_drive', function () use($app){
  $post = (object) $app->request->post();
  $drive = new Drive();
  $drive->name = $post->name;
  $drive->controller_id = $post->controller_id;
  $drive->disk_id = $post->disk_id;
  $drive->available = (isset($post->available)) ? $post->available : false;
  $drive->save();
  $app->redirect($app->urlFor('drives'));
})->name('add_drive');

$app->get('/networks', function() use($app){
  $app->render('view_networks.twig');
})->name('networks');

$app->get('/networks.json', function() use($app){
    $networks = Network::all();
    echo $networks->toJson();
});

$app->get('/new_network', function () use($app){
  $data = array();
  $app->render('add_networks.twig', $data);
})->name('new_network');

$app->post('/new_network', function () use($app){
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
  $app->redirect($app->urlFor('networks'));
})->name('add_network');

$app->get('/distributions', function() use($app){
  $app->render('view_distributions.twig');
})->name('distributions');

$app->get('/distributions.json', function() use($app){
    $distributions = Distribution::all();
    echo $distributions->toJson();
});

$app->get('/new_distribution', function () use($app){
  $data = array();
  $app->render('add_distributions.twig', $data);
})->name('new_distribution');

$app->post('/new_distribution', function() use($app){
  $post = (object) $app->request->post();
  $distribution = new Distribution();
  $distribution->name = $post->name;
  $distribution->display_order = $post->display_order;
  $distribution->is_trace_generator = (isset($post->is_trace_generator)) ? $post->is_trace_generator : false;
  $distribution->available = (isset($post->available)) ? $post->available : false;
  $distribution->save();
  $app->redirect($app->urlFor('distributions'));
})->name('add_distribution');

$app->get('/distributors', function() use($app){
  $app->render('view_distributors.twig');
})->name('distributors');

$app->get('/distributors.json', function() use($app){
  $distributors = Distributor::with('distribution')->get();
  for ($i=0; $i < $distributors->count(); $i++) {
      $distributors[$i]->distribution_name = $distributors[$i]->distribution->name;
    }
    echo $distributors->toJson();
});

$app->get('/new_distributor', function () use($app){
  $data = array();
  $data['distributions'] = Distribution::select('id as value', 'name as label')->where('is_trace_generator',false)->get();
  $app->render('add_distributors.twig', $data);
})->name('new_distributor');

$app->post('/new_distributor', function () use($app){
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
  $app->redirect($app->urlFor('distributor'));
})->name('add_distributor');

$app->get('/statuses', function() use($app){
  $app->render('view_statuses.twig');
})->name('statuses');

$app->get('/statuses.json', function() use($app){
    $statuses = Status::all();
    echo $statuses->toJson();
});

$app->post('/add_status', function () use($app){
  $post = (object) $app->request->post();
  $drive = new Status();
  $drive->name = $post->name;
  $drive->save();
  $app->redirect($app->urlFor('statuses'));
})->name('add_status');

$app->get('/users', function() use($app){
  $app->render('view_users.twig');
})->name('users');

$app->get('/users.json', function() use($app){
    $users = User::with('organization')->get();
    for ($i=0; $i < $users->count(); $i++) {
      $users[$i]->organization_name = $users[$i]->organization->name;
    }
    echo $users->toJson();
});

?>
