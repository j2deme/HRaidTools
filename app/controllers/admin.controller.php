<?php

$app->group('/admin', function() use($app){

  $app->get('/dashboard', function() use($app){
    echo "Hey admin";
  });

  $app->get('/disks', function() use($app){
    echo "Todos los Disks";
  });

$app->group('/disk', function() use($app){

  $app->get('/', function() use($app){
    echo "New disks";
  });

});


});

?>
