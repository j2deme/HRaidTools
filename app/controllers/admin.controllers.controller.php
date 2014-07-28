<?php

$app->group('/controllers', function() use($app){

  $app->get('', function() use($app){
    $app->render('view_controllers.twig');
  })->name('controllers');

  $app->get('/controllers.json(/:id)', function($id = null) use($app){
    if($id == null){
      $controllers = Controller::all();
      echo $controllers->toJson();
    }else{
      $controller = Controller::where('id',$id)->first();
      echo $controller->toJson();
    }
  });

  $app->get('/new-controller', function () use($app){
    $data = array();
    $app->render('add_controllers.twig', $data);
  })->name('new-controller');

  $app->post('/new-controller', function () use($app){
    $post = (object) $app->request->post();
    $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
    if($id != 0){
      $controller = Controller::where('id',$id)->first();
    }else{
      $controller = new Controller();
    }
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
  })->name('add-controller');

  $app->get('/edit-controller/:id', function($id) use($app){
    $data['controller'] = Controller::where('id',$id)->first();
    $app->render('add_controllers.twig', $data);
  })->name('edit-controller');

  $app->get('/toggle-controller/:id', function($id) use($app){
    $controller = Controller::where('id',$id)->first();
    $controller->available = ($controller->available) ? false : true;
    $controller->save();
    $app->redirect($app->urlFor('controllers'));
  })->name('toggle-controller');

  $app->get('/delete-controller/:id', function($id) use($app){
    $controller = Controller::where('id',$id)->first();
    $controller->delete();
    $app->redirect($app->urlFor('controllers'));
  })->name('delete-controller');

});

 ?>
