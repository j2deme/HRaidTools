<?php

$app->get('/', function() use($app){
  $data = array();
  $app->render('index.twig', $data);
})->name('root');

$app->get('/papers', function() use($app){
  $data = array();
  $app->render('papers.twig', $data);
})->name('papers');

$app->get('/staff', function() use($app){
  $data = array();
  $app->render('staff.twig', $data);
})->name('staff');

$app->get('/about', function() use($app){
  $data = array();
  $app->render('about.twig', $data);
})->name('about');

$app->get('/sign-up', function() use($app){
  $data = array();
  $data['organizations'] = Organization::all();
  $app->render('new_user.twig', $data);
})->name('signup');

$app->post('/sign-up', function() use($app){
  $post = (object) $app->request->post();
  $user = new User();
  $user->username = $post->username;
  $user->email = $post->email;
  $user->password = md5($post->password);
  $user->name = $post->name;
  $user->lastname = $post->lastname;
  $user->lastname_second = $post->lastname_second;
  $org = Organization::where('name','=',$post->organization_id)->first();
  if(is_null($org)){
    $org = new Organization();
    $org->name = trim($post->organization_id);
    $org->save();
  }
  $user->organization_id = $org->id;
  $user->save();
  $app->redirect($app->urlFor('root'));
})->name('signup-post');

?>
