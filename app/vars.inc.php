<?php
define('TITLE', 'Seed');
// Folders
define('ROOT', dirname(__DIR__).'/');
define('APP_FOLDER', ROOT.'app/');
define('PUBLIC_FOLDER', ROOT.'public/');
define('CSS_FOLDER', PUBLIC_FOLDER.'css/');
define('JS_FOLDER', PUBLIC_FOLDER.'js/');
define('IMG_FOLDER', PUBLIC_FOLDER.'img/');
define('MODELS_FOLDER', APP_FOLDER.'models/');
define('VIEWS_FOLDER', APP_FOLDER.'views/');
define('CONTROLLERS_FOLDER', APP_FOLDER.'controllers/');
define('LANGS_FOLDER',APP_FOLDER.'lang/');
// Database
define('DB_DRIVER', 'mysql');//mysql,pgsql
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'test');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_COLLATION', 'utf8_general_ci');
define('DB_CHARSET', 'utf8');
define('DB_PREFIX', '');
// Slim Vars
define('COOKIE_PREFIX','seed');//Letters, numbers and _
define('COOKIES_ENABLED', true);//Max size 4 kb
define('COOKIE_SECRET', 'secretseed');
define('COOKIE_DURATION', '20 minutes');
define('COOKIE_NAME', COOKIE_PREFIX);

$_ENV['SLIM_MODE'] = 'development';//development,production
