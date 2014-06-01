<?php

  $app->get('/testing', function () use($app){
    $data = array();
    $app->render('testing2.twig', $data);
  })->name('testing');
/*
  $app->get('/testing2' function () use($app){
    $data = array();
    $app->render('testing2.twig', $data);
  })->name('testing2');
*/
?>
