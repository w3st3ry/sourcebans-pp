<?php

define('IS_UPDATE', true);
include "../init.php";

require_once('Updater.php');
$updater = new Updater($GLOBALS['PDO']);

$theme->assign('updates', $updater->getMessageStack());
$theme->display('updater.tpl');

//clear compiled themes
$cachedir = dir(SB_CACHE);
while (($entry = $cachedir->read()) !== false) {
    if (is_file($cachedir->path . $entry)) {
        unlink($cachedir->path . $entry);
    }
}
$cachedir->close();
