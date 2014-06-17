<?php

$app->post('/new_user', function () {
  $post = (object) $app->request->post();
  $user = new User();
  $user->username = $post->username;
  $user->password = $post->password;
  $user->name = $post->name;
  $user->lastname = $post->lastname;
  $user->lastname_second = $post->lastname_second;
  $user->email = $post->email;
  $user->organization_id = $post->organization_id;
  $user->save();
});

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

/*
GET    /user/:id
POST   /user/
PUT    /user/:id
DELETE /user/:id
*/
?>
