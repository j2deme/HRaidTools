<?php

  $app->get('/testing', function () use($app){
    $data = array();
    $data['networks'] = array('10 Gigabit Ethernet','Gigabit Ethernet','Fast Ethernet');
    $app->render('testing2.twig', $data);
  })->name('testing');
/*
  $app->get('/testing2' function () use($app){
    $data = array();
    $app->render('testing2.twig', $data);
  })->name('testing2');
*/
?>
