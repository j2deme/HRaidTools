<?php

 $app->get('/testing_index', function () use($app){
    $data = array();
    $app->render('testing_index.twig', $data);
  })->name('t_index');

  $app->get('/testing_papers', function () use($app){
    $data = array();
    $app->render('testing_papers.twig', $data);
  })->name('t_papers');

  $app->get('/testing_staff', function () use($app){
    $data = array();
    $app->render('testing_staff.twig', $data);
  })->name('t_staff');

  $app->get('/testing_about', function () use($app){
    $data = array();
    $app->render('testing_about.twig', $data);
  })->name('t_about');

  $app->get('/testing2', function () use($app){
    $data = array();
    $data['networks'] = array('10 Gigabit Ethernet','Gigabit Ethernet','Fast Ethernet');
    $app->render('testing2.twig', $data);
  })->name('testing2');

  $app->get('/testing3', function () use($app){
    $data = array();
    $app->render('testing3.twig', $data);
  })->name('testing3');

 $app->get('/testing', function () use($app){
    $data = array();
    $app->render('testing.twig', $data);
  })->name('testing');

?>
