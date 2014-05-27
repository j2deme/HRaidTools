# HRaidTools
## Description

This repo contains a basic setup of the following frameworks:

- Slim/Slim (for routing)
- Twig/Twig (for templating)
- Illuminate/Eloquent (for database querying)

They've been setup in order to require a minimal configuration, and to work _out-of-the-box_ for
new projects. They follow the MVC (_Model, View, Controller_) pattern with an extra spice of OOP (_Object Oriented Programming_).

Some extra server-side libraries are included too:

- Nesbot/Carbon (for server side date manipulation)
- Illuminate/Validation (for model validation)

In the front-end _Seed_ includes:

- Bootstrap 3.0.1 (Minified, CSS and JS)
- FontAwesome 4.0.3 (Minified, _Glyphicons also available_)
- Animate.css 3.0.0 (Minified)
- jQuery 2.1.0 (Minified)
- Moment-JS 2.5.1 (Minified with all languages)
- Charts-JS (Minified)

The basic template is a combination of H5BP and Boostrap, and includes HTML5Shiv and Respond.js for
IE < 10.

## Configuration

_Seed_ requires a minimum configuration, that can be performed by editing `vars.inc.php` as needed.

```php
define('TITLE', 'Seed');
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'test');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_PREFIX', '');
// Slim Vars
define('COOKIES_ENABLED', true);
define('COOKIE_SECRET', 'secretseed');
define('COOKIE_DURATION', '20 minutes');

$_ENV['SLIM_MODE'] = 'development';//development,production
```
__TITLE__: Is the title or name for the app or website, it will appear on the title of the tab and on the navigation bar.

__DB\_DRIVER__: Options available: MySQL(mysql, _default_) and postgresql (pgsql).

__DB\_HOST__: Commonly localhost (127.0.0.1) or the ip from the remote server.

__DB\_DATABASE__: Database name.

__DB\_USERNAME__: Database user.

__DB\_PASSWORD__: Database password.

__DB\_PREFIX__: If your tables are prefixed (Empty by default).

__COOKIES\_ENABLED__: If false, session variables will be stored in PHP native sessions.

__COOKIE\_SECRET__: Every cookie is ciphered using this key.

__COOKIE\_DURATION__: Server side cookies will last the specified time.


The navbar supports both left (default) and right menus to set a new option use: Opt::nw()->init(text,url)

# Authors
- Jaime Delgado Meraz
- Alfredo Barrón Rodríguez
