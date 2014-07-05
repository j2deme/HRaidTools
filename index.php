<?php
session_cache_limiter(false);
session_start();
date_default_timezone_set('America/Mexico_City');
require 'vendor/autoload.php';
include_once 'app/vars.inc.php';
include_once APP_FOLDER.'config.php';

//Load all the models
include_once MODELS_FOLDER."Elegant.php";
foreach(glob(MODELS_FOLDER.'*.php') as $model) {
  if($model != "Elegant.php")
    include_once $model;
}

$auth = function ($app) {
  return function () use ($app) {
    if (!isset($_SESSION['user'])) {
      //$_SESSION['redirectTo'] = $app->request()->getPathInfo();
      $app->flash('error', $app->lang->loginError);
      $app->flashKeep();
      $app->redirect($app->urlFor('login'));
    }
  };
};

$app->hook('slim.before.dispatch', function() use ($app) {
  $user = null;
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }
  $app->view()->appendData(array('user' => $user));
});

$app->get('/login', function() use($app){
  $flash = $app->view()->getData('flash');
  $error = '';
  if(isset($flash['error'])) {
    $error = $flash['error'];
  }
  $redirectTo = $app->urlFor('root');
  /*if($app->request()->get('r') and ($app->request()->get('r') != $app->urlFor('logout')) and ($app->request()->get('r') != $app->urlFor('login'))) {
    $_SESSION['redirectTo'] = $app->request()->get('r');
  }

  if(isset($_SESSION['redirectTo'])) {
    $redirectTo = $_SESSION['redirectTo'];
  }*/

  $emailValue = $emailError = $passwordError = '';
  if(isset($flash['email'])) {
    $emailValue = $flash['email'];
  }

  if(isset($flash['errors']['email'])) {
    $emailError = $flash['errors']['email'];
  }

  if(isset($flash['errors']['password'])) {
    $passwordError = $flash['errors']['password'];
  }

  $data = array(
    'error' => $error,
    'emailValue' => $emailValue,
    'emailError' => $emailError,
    'passwordError' => $passwordError,
    'redirectTo' => $redirectTo
  );
  $app->render('login.twig', $data);
})->name('login');

$app->post('/login', function() use($app){
  $post = (object) $app->request()->post();
  $username = (isset($post->username)) ? $post->username : '';
  $password = (isset($post->password)) ? $post->password : '';
  if($username == "admin" and $password == "admin") {
    $_SESSION['user'] = 'admin';
    $app->redirect($app->urlFor('admin'));
  }

  $errors = array();
  $user = User::with('Organization')->where('username','=',$username)->orWhere('email','=',$username)->first();
  if(!is_null($user)){
    if($user->password == md5($password)){
      $_SESSION['user'] = $user;
    } else {
      $errors['password'] = $app->lang->passwordError;
    }
  } else {
    $app->flash('email', $username);
    $errors['email'] = $app->lang->emailError;
  }

  if(count($errors) > 0) {
    $app->flash('errors', $errors);
    $app->flashKeep();
    $app->redirect($app->urlFor('login'));
  }

  /*if(isset($_SESSION['redirectTo'])) {
    $tmp = $_SESSION['redirectTo'];
    unset($_SESSION['redirectTo']);
    $app->redirect($tmp);
  }*/

  $app->redirect($app->urlFor('dashboard'));
})->name('login-post');

$app->get('/logout', function() use($app){
  unset($_SESSION['user']);
  $app->view()->setData('user', null);
  $app->redirect($app->urlFor('root'));
})->name('logout');

//Load all the controllers
foreach(glob(CONTROLLERS_FOLDER.'*.php') as $router) {
  include_once $router;
}

//For routes that need login you should add $auth($app)
/*
$app->get('/private/', $auth($app), function () use ($app) {
  $app->render('private.twig');
});
*/

$app->run();
?>
