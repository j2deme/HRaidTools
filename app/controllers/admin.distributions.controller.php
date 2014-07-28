<?php

$app->group('/distributions', function() use($app){

  $app->get('', function() use($app){
      $app->render('view_distributions.twig');
    })->name('distributions');

    $app->get('/distributions.json(/:id)', function($id = null) use($app){
        if($id == null){
          $distributions = Distribution::all();
          echo $distributions->toJson();
        }else{
          $distribution = Distribution::where('id',$id)->first();
          echo $distribution->toJson();
        }
    });

    $app->get('/new-distribution', function () use($app){
      $data = array();
      $app->render('add_distributions.twig', $data);
    })->name('new-distribution');

    $app->post('/new-distribution', function() use($app){
      $post = (object) $app->request->post();
      $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
      if($id != 0){
        $distribution = Distribution::where('id',$id)->first();
      }else{
        $distribution = new Distribution();
      }
      $distribution = new Distribution();
      $distribution->name = $post->name;
      $distribution->display_order = $post->display_order;
      $distribution->is_trace_generator = (isset($post->is_trace_generator)) ? $post->is_trace_generator : false;
      $distribution->available = (isset($post->available)) ? $post->available : false;
      $distribution->save();
      $app->redirect($app->urlFor('distributions'));
    })->name('add-distribution');

    $app->get('/edit-distribution/:id', function($id) use($app){
      $data['distribution'] = Distribution::where('id',$id)->first();
      $app->render('add_distributions.twig', $data);
    })->name('edit-distribution');

    $app->get('/toggle-distribution/:id', function($id) use($app){
      $distribution = Distribution::where('id',$id)->first();
      $distribution->available = ($distribution->available) ? false : true;
      $distribution->save();
      $app->redirect($app->urlFor('distributions'));
    })->name('toggle-distribution');

    $app->get('/delete-distribution/:id', function($id) use($app){
      $distribution = distribution::where('id',$id)->first();
      $distribution->delete();
      $app->redirect($app->urlFor('distributions'));
    })->name('delete-distribution');

});

 ?>
