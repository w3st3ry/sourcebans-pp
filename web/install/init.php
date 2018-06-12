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

//TODO: add timezone check

require_once(SBPP.'/includes/Database.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Create a blank config file
if (!file_exists("../config.php") && is_writable('../')) {
    $handle = fopen("../config.php", "w");
    fclose($handle);
}
