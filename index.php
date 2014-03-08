<?php
session_cache_limiter(false);
session_start();
date_default_timezone_set('America/Mexico_City');
require 'vendor/autoload.php';
require_once 'app/vars.inc.php';
require_once APP_FOLDER.'config.php';

$auth = function ($app) {
  return function () use ($app) {
    if (!isset($_SESSION['user'])) {
      $_SESSION['urlRedirect'] = $app->request()->getPathInfo();
      $app->flash('error', $app->lang->login_required);
      $app->redirect($app->urlFor('login'));
    }
  };
};

$app->hook('slim.before.dispatch', function() use ($app) {
  $user = null;
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }
  $app->view()->setData('user', $user);
});

$app->get('/',function() use($app){
  $data = array();
  $app->render('index.twig', $data);
})->name('root');

$app->get('/login',function() use($app){
  $post = (object) $app->request()->post();
  $email = $post->email;
  $password = $post->password;

  $errors = array();
  if($email != "j2deme@gmail.com") {//Get it from database
      $errors['email'] = $app->lang->email_error;
  } elseif ($password != "12345") {//Get it from database
    $app->flash('email', $email);
    $errors['password'] = $app->lang->password_error;
  }

  if(count($errors) > 0) {
    $app->flash('errors', $errors);
    $app->redirect($app->urlFor('login'));
  }

  $_SESSION['user'] = $email;

  if(isset($_SESSION['urlRedirect'])) {
    $tmp = $_SESSION['urlRedirect'];
    unset($_SESSION['urlRedirect']);
    $app->redirect($tmp);
  }

  $app->redirect($app->urlFor('root'));
})->name('login');

$app->post('/login',function() use($app){
  $flash = $app->view()->getData('flash');
  $error = '';
  if(isset($flash['error'])) {
    $error = $flash['error'];
  }
  $urlRedirect = $app->urlFor('root');
  if($app->request()->get('r') and $app->request()->get('r') != $app->urlFor('logout') and $app->request()->get('r') != $app->urlFor('login')) {
    $_SESSION['urlRedirect'] = $app->request()->get('r');
  }

  if(isset($_SESSION['urlRedirect'])) {
    $urlRedirect = $_SESSION['urlRedirect'];
  }

  $email_value = $email_error = $password_error = '';

  if(isset($flash['email'])) {
    $email_value = $flash['email'];
  }

  if(isset($flash['errors']['email'])) {
    $email_error = $flash['errors']['email'];
  }

  if(isset($flash['errors']['password'])) {
    $password_error = $flash['errors']['password'];
  }

  $data = array(
    'error' => $error,
    'email_value' => $email_value,
    'email_error' => $email_error,
    'password_error' => $password_error,
    'urlRedirect' => $urlRedirect
  );
  $app->render('login.php', $data);
})->name('login-post');

$app->get('/logout', function() use($app){
  unset($_SESSION['user']);
  $app->view()->setData('user', null);
  $app->redirec($app->urlFor('root'));
})->name('logout');

//Load all the controllers
foreach(glob(CONTROLLERS_FOLDER.'*.php') as $router) {
  include_once $router;
}

/*
For routes that need authentification
$app->get('/private/', $auth($app), function () use ($app) {
  $app->render('private.twig');
});
*/

$app->run();
?>
