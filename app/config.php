<?php
include_once 'vars.inc.php';
include_once 'arrays.php';
include_once LANGS_FOLDER.'lang.common.php';

$app = new \Slim\Slim();
if (COOKIES_ENABLED) {
  $app->add(new \Slim\Middleware\SessionCookie(array(
    'secret'  => COOKIE_SECRET,
    'expires' => COOKIE_DURATION,
    'name'    => COOKIE_NAME
  )));
}

$app->config(array(
  'templates.path' => VIEWS_FOLDER,
  'view'           => new \Slim\Views\Twig()
));

$app->configureMode('production', function () use ($app) {
  $app->config(array(
    'log.enabled' => true,
    'debug'       => false
  ));
});

$app->configureMode('development', function () use ($app) {
  $app->config(array(
    'log.enabled' => false,
    'debug'       => true
  ));
});

$app->notFound(function () use ($app) {
  $app->render('404.twig');
});

//Language
$language = $app->getCookie(COOKIE_PREFIX.'.lang');
if($language == null or $language == 'en'){
  include_once LANGS_FOLDER.'lang.en.php';
} else {
  switch ($language) {
    case 'es':
      include_once LANGS_FOLDER.'lang.es.php';
      break;
    default:
      include_once LANGS_FOLDER.'lang.en.php';
      break;
  }
}
$app->lang = $locale;

$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$resourceUri = $_SERVER['REQUEST_URI'];

$view = $app->view();
$view->parserExtensions = array(new \Slim\Views\TwigExtension());
$view->appendData(array(
  'title' => TITLE,
  'app' => $app,
  'root' => $rootUri,
  'assetUri' => $assetUri,
  'activeUrl' => $resourceUri,
  'css'  => CSS_FOLDER,
  'js'   => JS_FOLDER,
  'img'  => IMG_FOLDER,
  'lang' => $locale
));

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection(array(
  'driver'    => DB_DRIVER,
  'host'      => DB_HOST,
  'database'  => DB_DATABASE,
  'username'  => DB_USERNAME,
  'password'  => DB_PASSWORD,
  'prefix'    => DB_PREFIX,
  'charset'   => DB_CHARSET,
  'collation' => DB_COLLATION,
));
$capsule->bootEloquent();
$capsule->setAsGlobal();
$app->db = $capsule->connection();
?>
