<?php

$app->group('/disks', function () use($app){

    $app->get('', function () use($app){
    $app->render('view_disks.twig');
    })->name('disks');

    $app->get('/new-disk', function () use($app){
      $data = array();
      $data['unit'] = array('KB','MB','GB','TB', 'PB');
      $app->render('add_disks.twig', $data);
    })->name('new-disk');

    $app->get('/disks.json(/:id)', function($id = null) use($app){
      if($id == null){
        $disks = Disk::all();
        echo $disks->toJson();
      }else{
        $disk = Disk::where('id',$id)->first();
        echo $disk->toJson();
      }
    });

    $app->post('/new-disk', function () use($app){
      $post = (object) $app->request->post();
      $id = (isset($post->id) and !empty($post->id)) ? $post->id : 0;
      if($id != 0){
        $disk = Disk::where('id',$id)->first();
      }else{
        $disk = new Disk();
      }
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
    })->name('add-disk');

    $app->get('/edit-disk/:id', function($id) use($app){
      $data['disk'] = Disk::where('id',$id)->first();
      $data['unit'] = array('KB','MB','GB','TB', 'PB');
      $app->render('add_disks.twig', $data);
    })->name('edit-disk');

    $app->get('/toggle-disk/:id', function($id) use($app){
      $disk = Disk::where('id',$id)->first();
      $disk->available = ($disk->available) ? false : true;
      $disk->save();
      $app->redirect($app->urlFor('disks'));
    })->name('toggle-disk');

    $app->get('/delete-disk/:id', function($id) use($app){
      $disk = Disk::where('id',$id)->first();
      $disk->delete();
      $app->redirect($app->urlFor('disks'));
    })->name('delete-disk');

  });

?>
