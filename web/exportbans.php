<?php
require_once('init.php');

$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);

if (!$userbank->HasAccess(ADMIN_OWNER) && !$GLOBALS['config']['config.exportpublic']) {
    die("You don't have access to this feature.");
} elseif (is_null($type)) {
    die('Parameter "type" not set.');
}

if ($type === 'steam') {
    $file = 'banned_user.cfg';
    $cmd = 'banid';
    $GLOBALS['PDO']->query("SELECT authid AS id FROM `:prefix_bans` WHERE length = 0 AND RemoveType IS NULL AND type = 0");
} elseif ($type === 'ip') {
    $file = 'banned_ip.cfg';
    $cmd = 'addip';
    $GLOBALS['PDO']->query("SELECT ip AS id FROM `:prefix_bans` WHERE length = 0 AND RemoveType IS NULL AND type = 1");
}

header('Content-Type: application/x-httpd-php php');
header('Content-Disposition: attachment; filename="'.$file.'"');
foreach ($GLOBALS['PDO']->resultset() as $ban) {
    print "$cmd 0 $ban[id] \r\n";
}
