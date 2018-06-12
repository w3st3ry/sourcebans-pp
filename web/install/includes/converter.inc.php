<?php

define('IN_SB', true);
require_once("../config.php");
require_once('../includes/Database.php');


function convertAmxbans($oldDB, $newDB)
{
    set_time_limit(0); //Never time out
    ob_start();
    if (!$oldDB) {
        die("Failed to connect to AMX Bans database");
    }

    echo "Converting ".$oldDB->getPrefix()."_bans... ";
    ob_flush();
    flush();
    $oldDB->query('SELECT `player_ip`, `player_id`, `player_nick`, `ban_created`, `ban_length`, `ban_reason`, `admin_ip` FROM `:prefix_bans`');
    $data = $oldDB->resultset();
    $oldDB->query('SELECT UNIX_TIMESTAMP() AS time FROM :prefix_bans');
    $time = $oldDB->single();

    if (!$newDB) {
        die("Failed to connect to SourceBans database");
    }

    $newDB->query('INSERT INTO `:prefix_bans` (ip, authid, name, created, ends, length, reason, adminIp, aid) VALUES (:ip, :authid, :name, :created, :ends, :length, :reason, :adminIp, :aid)');

    foreach ($data as $value) {
        $newDB->bind(':ip', $value['player_ip']);
        $newDB->bind(':authid', $value['player_id']);
        $newDB->bind(':name', $value['player_nick']);
        $newDB->bind(':created', $value['ban_created']);
        $newDB->bind(':ends', $value['ban_length'] == 0 ? 0 : $value['ban_created']+$value['ban_length']);
        $newDB->bind(':length', $value['ban_length']);
        $newDB->bind(':reason', $value['ban_reason']);
        $newDB->bind(':adminIp', $value['admin_ip']);
        $newDB->bind(':aid', 0);

        $newDB->execute();
    }
    echo "OK<br>";
}
