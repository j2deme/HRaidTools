<?php

$app->group('/drives', function() use($app){

  $app->get('', function() use($app){
    $app->render('view_drives.twig');
  })->name('drives');

  $app->get('/drives.json(/:id)', function($id = null) use($app){
    if($id == null){
      $drives = Drive::with('disk','controller')->get();
      for ($i=0; $i < $drives->count(); $i++) {
        $drives[$i]->controller_name = $drives[$i]->controller->name;
        $drives[$i]->disk_name = $drives[$i]->disk->name;
      }
      echo $drives->toJson();
    }else{
      $drive = Drive::with('disk','controller')->where('id',$id)->first();
      echo $drive->toJson();
    }
  });

  $app->get('/new-drive', function () use($app){
    $data = array();
    $data['controller'] = Controller::select('id as value', 'name as label')->where('available',true)->get();
    $data['disk'] = Disk::select('id as value', 'name as label')->where('available',true)->get();
    $app->render('add_drives.twig', $data);
  })->name('new-drive');

  $app->get('/views-c/:id', function($id) use($app){
      $controller = Controller::where('id',$id)->first();
      echo $controller->toJson();
  });

  $app->get('/views-d/:id', function($id) use($app){
      $disk = Disk::where('id',$id)->first();
      echo $disk->toJson();
  });

  $app->post('/add-drive', function () use($app){
    $post = (object) $app->request->post();
    $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
    if($id != 0){
      $drive = Drive::where('id',$id)->first();
    }else{
      $drive = new Drive();
    }
    $drive->name = $post->name;
    $drive->controller_id = $post->controller_id;
    $drive->disk_id = $post->disk_id;
    $drive->available = (isset($post->available)) ? $post->available : false;
    $drive->save();
    $app->redirect($app->urlFor('drives'));
  })->name('add-drive');

  $app->get('/edit-drive/:id', function($id) use($app){
    $data = array();
    $data['drive'] = Drive::where('id',$id)->first();
    $data['controller'] = Controller::select('id as value', 'name as label')->where('available',true)->get();
    $data['disk'] = Disk::select('id as value', 'name as label')->where('available',true)->get();
    $app->render('add_drives.twig', $data);
  })->name('edit-drive');

  $app->get('/toggle-drive/:id', function($id) use($app){
    $drive = Drive::where('id',$id)->first();
    $drive->available = ($drive->available) ? false : true;
    $drive->save();
    $app->redirect($app->urlFor('drives'));
  })->name('toggle-drive');

  $app->get('/delete-drive/:id', function($id) use($app){
    $drive = Drive::where('id',$id)->first();
    $drive->delete();
    $app->redirect($app->urlFor('drives'));
  })->name('delete-drive');

});

 ?>
