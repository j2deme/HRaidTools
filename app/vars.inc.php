<?php
define('TITLE', 'HRaidTools');
// Database
define('DB_DRIVER', 'pgsql');//mysql,pgsql
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'ht');
define('DB_USERNAME', 'ht');
define('DB_PASSWORD', 'ht.2014');
define('DB_PREFIX', '');
// Slim Vars
define('COOKIE_PREFIX','ht');//Only lowercase letters[a-z], numbers[0-9] and _
define('COOKIES_ENABLED', true);//If you need to store more than 4 kb set to false
define('COOKIE_SECRET', 'htsecret');//Change for a different secret
define('COOKIE_DURATION', '20 minutes');//Default value, change as needed

define('SLIM_MODE','development');//development,production

// ATTENTION! Do not change, unless you know what you are doing.
define('ROOT', basename(dirname(__DIR__)).'/');
define('APP_FOLDER', 'app/');
define('PUBLIC_FOLDER', 'public/');
define('CSS_FOLDER', PUBLIC_FOLDER.'css/');
define('JS_FOLDER', PUBLIC_FOLDER.'js/');
define('IMG_FOLDER', PUBLIC_FOLDER.'img/');
define('PDF_FOLDER', PUBLIC_FOLDER.'pdf/');
define('MODELS_FOLDER', APP_FOLDER.'models/');
define('VIEWS_FOLDER', APP_FOLDER.'views/');
define('CONTROLLERS_FOLDER', APP_FOLDER.'controllers/');
define('LANGS_FOLDER',APP_FOLDER.'lang/');
define('COOKIE_NAME', COOKIE_PREFIX);
define('DB_COLLATION', 'utf8_general_ci');
define('DB_CHARSET', 'utf8');
?>
