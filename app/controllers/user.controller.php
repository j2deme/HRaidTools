<?php

$app->get('/dashboard', $auth($app), function() use($app){
  $data = array();
  $user = $_SESSION['user'];
  $id = $user->organization_id;
  //$data['organization'] = Organization::where('id','=',$id)->first();
  //$data['user'] = User::with
  $app->render('dashboard.user.twig', $data);
})->name('dashboard');

$app->group('/user', function () use ($app) {
  // Get book with ID
  $app->get('/:id', function ($id) use ($app) {
  });

  $app->post('/', function () use ($app) {
  });

  // Update book with ID
  $app->put('/:id', function ($id) use ($app) {
  });

  // Delete book with ID
  $app->delete('/:id', function ($id) use ($app) {
  });
});

$app->get('/avatar/:text', function($text) use ($app){
  $salt = '';
  $grid_size = 6;
  $unit = 25;
  $hash = str_split(sha1($text.$salt), 2);
  $foreground = "{$hash[0]}{$hash[1]}{$hash[2]}";
  $background = "{$hash[2]}{$hash[3]}{$hash[4]}";
  $middle = ceil($grid_size / 2);
  $gen_up_to = $grid_size * $middle;

  $colors = array();
  for( $i = 0; $i < $gen_up_to; $i++ ){
    if(hexdec($hash[$i]) % 10 < 5){
      $colors[] = $foreground;
    } else {
      $colors[] = $background;
    }
  }

  if($grid_size % 2 == 0){
    $mirror = array_reverse(array_chunk($colors, $grid_size));
  } else {
    $mirror = array_reverse(array_chunk(array_slice($colors, 0, $grid_size * ($middle - 1)), $grid_size));
  }

  foreach($mirror as $m){
    $colors = array_merge($colors, $m);
  }

  $side_size = $grid_size * $unit;
  $im = imagecreatetruecolor($side_size, $side_size);
  $wpos = 0;
  $hpos = 0;

  foreach($colors as $color){
    $color = '0x00'.$color;
    imagefilledrectangle($im, $wpos, $hpos, $wpos + $unit, $hpos + $unit, $color);
    $hpos += $unit;
    // new col
    if($hpos == $side_size){
      $wpos += $unit;
      $hpos = 0;
    }
  }

  header('Content-Type: image/png');
  header('Content-Disposition: filename="avatar.png"');
  imagepng($im);
  imagedestroy($im);
})->name('avatar');

/*
GET    /user/:id
POST   /user/
PUT    /user/:id
DELETE /user/:id
*/
?>
