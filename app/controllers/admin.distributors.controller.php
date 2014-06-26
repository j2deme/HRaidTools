<?php

$app->group('/distributors', function() use($app){

  $app->get('/distributors', function() use($app){
    $app->render('view_distributors.twig');
  })->name('distributors');

  $app->get('/distributors.json(/:id)', function($id = null) use($app){
    if($id == null){
      $distributors = Distributor::with('distribution')->get();
      for ($i=0; $i < $distributors->count(); $i++) {
        $distributors[$i]->distribution_name = $distributors[$i]->distribution->name;
      }
      echo $distributors->toJson();
    }else{
      $distributor = Distributor::with('distribution')->where('id',$id)->first();
      echo $distributor->toJson();
    }
  });

  $app->get('/new-distributor', function () use($app){
    $data = array();
    $data['distributions'] = Distribution::select('id as value', 'name as label')->where('is_trace_generator',false)->get();
    $app->render('add_distributors.twig', $data);
  })->name('new-distributor');

  $app->post('/new-distributor', function () use($app){
    $post = (object) $app->request->post();
    $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
    if($id != 0){
      $distributor = Distributor::where('id',$id)->first();
    }else{
      $distributor = new Distributor();
    }
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
  })->name('add-distributor');

  $app->get('/edit-distributor/:id', function($id) use($app){
    $data = array();
    $data['distributions'] = Distribution::select('id as value', 'name as label')->where('is_trace_generator',false)->get();
    $data['distributor'] = Distributor::where('id',$id)->first();
    $app->render('add_distributors.twig', $data);
  })->name('edit-distributor');

  $app->get('/toggle-distributor/:id', function($id) use($app){
    $distributor = Distributor::where('id',$id)->first();
    $distributor->available = ($distributor->available) ? false : true;
    $distributor->save();
    $app->redirect($app->urlFor('distributors'));
  })->name('toggle-distributor');

  $app->get('/delete-distributor/:id', function($id) use($app){
    $distributor = Distributor::where('id',$id)->first();
    $distributor->delete();
    $app->redirect($app->urlFor('distributors'));
  })->name('delete-distributor');

});

 ?>
