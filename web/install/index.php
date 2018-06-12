<?php
require_once('init.php');
require_once(INCLUDES_PATH.'/system-functions.php');
require_once(INCLUDES_PATH.'/page-builder.php');

ob_start();
[$title, $step] = route();
build($title, $step);
