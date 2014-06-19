<?php

$app->get('/new_user', function () use ($app) {
  $data = array();
  $app->render('new_user.twig', $data);
})->name('new_user');

$app->post('/sing_up', function () use ($app) {
  $post = (object) $app->request->post();
  $user = new User();
  $user->username = $post->username;
  $user->email = $post->email;
  $user->password = $post->password;
  $user->name = $post->name;
  $user->lastname = $post->lastname;
  $user->lastname_second = $post->lastname_second;
  $user->organization_id = $post->organization_id;
  $user->save();
  $app->redirect($app->urlFor('root'));
})->name('sign_up');

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
