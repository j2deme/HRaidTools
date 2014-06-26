<?php

$app->group('/networks', function() use($app){

  $app->get('', function() use($app){
    $app->render('view_networks.twig');
  })->name('networks');

  $app->get('/networks.json(/:id)', function($id = null) use($app){
      if($id == null){
        $networks = Network::all();
        echo $networks->toJson();
      }else{
        $network = Network::where('id',$id)->first();
        echo $network->toJson();
      }
  });

  $app->get('/new-network', function () use($app){
    $data = array();
    $app->render('add_networks.twig', $data);
  })->name('new-network');

  $app->post('/new-network', function () use($app){
    $post = (object) $app->request->post();
    $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
    if($id != 0){
      $network = Network::where('id',$id)->first();
    }else{
      $network = new Network();
    }
    $network->type = $post->type;
    $network->latency = $post->latency;
    $network->bandwidth = $post->bandwidth;
    $network->network = $post->network;
    $network->display_name = $post->display_name;
    $network->display_order = $post->display_order;
    $network->available = (isset($post->available)) ? $post->available : false;
    $network->save();
    $app->redirect($app->urlFor('networks'));
  })->name('add-network');

  $app->get('/edit-network/:id', function($id) use($app){
    $data['network'] = Network::where('id',$id)->first();
    $app->render('add_networks.twig', $data);
  })->name('edit-network');

  $app->get('/toggle-network/:id', function($id) use($app){
    $network = Network::where('id',$id)->first();
    $network->available = ($network->available) ? false : true;
    $network->save();
    $app->redirect($app->urlFor('networks'));
  })->name('toggle-network');

  $app->get('/delete-network/:id', function($id) use($app){
    $network = Network::where('id',$id)->first();
    $network->delete();
    $app->redirect($app->urlFor('networks'));
  })->name('delete-network');

});

 ?>
