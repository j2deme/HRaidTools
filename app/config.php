<?php
include_once 'vars.inc.php';
include_once 'arrays.php';
include_once LANGS_FOLDER.'lang.common.php';
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

$app = new \Slim\Slim();
if(COOKIES_ENABLED) {
  $app->add(new \Slim\Middleware\SessionCookie(array(
    'secret'  => md5(COOKIE_SECRET),
    'expires' => COOKIE_DURATION,
    'name'    => COOKIE_NAME
  )));
}

$app->config(array(
  'debug' => true,
  'templates.path' => VIEWS_FOLDER,
  'view' => new \Slim\Views\Twig(),
  'mode'           => SLIM_MODE
));

$app->configureMode('production', function () use ($app) {
  $app->config(array('log.enabled' => true, 'debug' => false));
});

$app->configureMode('development', function () use ($app) {
  $app->config(array('log.enabled' => false, 'debug' => true));
});

$app->notFound(function () use ($app) { $app->render('404.twig'); });

//Language
$langCookie = COOKIE_PREFIX.'.lang';
$selectedLangPrefix = $app->getCookie($langCookie);
$selectedLangPath = LANGS_FOLDER.'lang.'.$selectedLangPrefix.'.yml';
$defaultLang = $lang['langs'][0];
$defaultLangPath = LANGS_FOLDER.'lang.'.$defaultLang['suffix'].'.yml';

$yaml = new Parser();
try {
  $fallbackLang = $yaml->parse(file_get_contents($defaultLangPath));
  $lang = array_merge($lang,$fallbackLang);
} catch (ParseException $e) {
  printf("Unable to parse the YAML string: %s<hr>", $e->getMessage());
}

if($selectedLangPrefix != null){
  try {
    if(file_exists($selectedLangPath)){
      $selectedLang = $yaml->parse(file_get_contents($selectedLangPath));
      $lang = array_merge($lang,$selectedLang);
    }
  } catch (ParseException $e) {
    printf("Unable to parse the YAML string: %s<hr>", $e->getMessage());
  }
}

$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$resourceUri = $_SERVER['REQUEST_URI'];

include_once 'navbar.inc.php';
$app->lang = (object) $lang;

$view = $app->view();
$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new Twig_Extension_Debug()
);
$app->view()->appendData(array(
  'title' => TITLE,
  'app' => $app,
  'root' => $rootUri,
  'assetUri' => $assetUri,
  'activeUrl' => $resourceUri,
  'css'  => CSS_FOLDER,
  'js'   => JS_FOLDER,
  'img'  => IMG_FOLDER,
  'pdf' => PDF_FOLDER,
  'lang' => $lang,
  'langCookie' => $langCookie
));

//$app->view()->appendData(array('navbar' => $navbar));

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
