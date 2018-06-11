<?php
require_once('init.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);

if (is_null($id) || is_null($type)) {
    die('Parameter "id" or "type" not set.');
} elseif (!strcasecmp($type, 'B') && !strcasecmp($type, 'S')) {
    die('Bad type.');
}

$GLOBALS['PDO']->query("SELECT filename, origname FROM `:prefix_demos` WHERE demtype = :type AND demid = :id");
$GLOBALS['PDO']->bind(':type', $type);
$GLOBALS['PDO']->bind(':id', $id, \PDO::PARAM_INT);
$demo = $GLOBALS['PDO']->single();

if (!$demo) {
    die('Demo not found.');
}

$demo['filename'] = basename($demo['filename']);
if (!in_array($demo['filename'], scandir(SB_DEMOS)) || !file_exists(SB_DEMOS . "/" . $demo['filename'])) {
    die('Demo file not found.');
}

header('Content-type: application/force-download');
header('Content-Transfer-Encoding: Binary');
header('Content-disposition: attachment; filename="'.$demo['origname'].'"');
header("Content-Length: ".filesize(SB_DEMOS."/".$demo['filename']));
readfile(SB_DEMOS."/".$demo['filename']);
