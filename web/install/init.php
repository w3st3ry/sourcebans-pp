<?php

define('ROOT', __DIR__);
define('SBPP', ROOT.'/..');
define('TEMPLATES_PATH', ROOT.'/template');
define('INCLUDES_PATH', ROOT.'/includes');
define('IN_SB', true);
define('IN_INSTALL', true);

define('SB_VERSION', '1.7.0');

//Display all errors
ini_set('display_errors', 1);
error_reporting(-1);

//Default to UTC if no timezone is set in php.ini
if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

require_once(SBPP.'/includes/Database.php');

require_once(SBPP.'/includes/Mustache/Autoloader.php');
require_once(SBPP.'/includes/Template.php');
Mustache_Autoloader::register();

Template::init(new Mustache_Engine([
    'cache' => ROOT.'/cache',
    'loader' => new Mustache_Loader_FilesystemLoader(ROOT.'/templates')
]));

// Create a blank config file
if (!file_exists("../config.php") && is_writable('../')) {
    $handle = fopen("../config.php", "w");
    fclose($handle);
}
