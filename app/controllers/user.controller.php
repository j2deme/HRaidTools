<?php

$app->get('/dashboard', function() use($app){
  $data = array();
  $data['user'] = User::where('id',3)->firstOrFail();
  $app->render('dashboard.twig', $data);
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

/*
GET    /user/:id
POST   /user/
PUT    /user/:id
DELETE /user/:id
*/
?>
