<?php

$app->group('/admin', $auth($app), function() use($app){
  $app->get('', function() use($app){
    $data = array();
    $app->render('admin.twig', $data);
  })->name('admin');

  require_once('admin.disks.controller.php');
  require_once('admin.controllers.controller.php');
  require_once('admin.drives.controller.php');
  require_once('admin.networks.controller.php');
  require_once('admin.distributions.controller.php');
  require_once('admin.distributors.controller.php');

  $app->group('/statuses', function() use($app){
    $app->get('', function() use($app){
      $app->render('view_statuses.twig');
    })->name('statuses');

    $app->get('/statuses.json(/:id)', function($id = null) use($app){
        if($id == null){
          $statuses = Status::all();
          echo $statuses->toJson();
        }else{
          $status = Status::where('id',$id)->first();
          echo $status->toJson();
        }
    });

    $app->post('/add-status', function () use($app){
      $post = (object) $app->request->post();
      $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
      if($id != 0){
        $status = Status::where('id',$id)->first();
      }else{
        $status = new Status();
      }
      $status->name = $post->name;
      $status->save();
      $app->redirect($app->urlFor('statuses'));
    })->name('add-status');

    $app->get('/delete-status/:id', function($id) use($app){
      $status = Status::where('id',$id)->first();
      $status->delete();
      $app->redirect($app->urlFor('statuses'));
    })->name('delete-status');
  });

  $app->group('/users', function() use($app){
    $app->get('', function() use($app){
      $app->render('view_users.twig');
    })->name('users');

    $app->get('/users.json(/:id)', function($id = null) use($app){
        if($id == null){
          $users = User::with('organization')->get();
          for ($i=0; $i < $users->count(); $i++) {
            $users[$i]->organization_name = $users[$i]->organization->name;
          }
          echo $users->toJson();
        }else{
          $user = User::with('organization')->where('id',$id)->first();
          echo $user->toJson();
        }
    });
  });

});

$app->get('/organizations.json', function() use($app){
  //$organizations = Organization::select('name')->get();
  //echo $organizations->toJson();
  echo Organization::all();
})->name('organizations-json');
?>
