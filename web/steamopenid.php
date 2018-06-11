<?php

include_once 'init.php';
include_once 'config.php';
require_once 'includes/openid.php';

function steamOauth()
{
    $openid = new LightOpenID(SB_WP_URL);
    if (!$openid->mode) {
        $openid->identity = 'https://steamcommunity.com/openid';
        header("Location: " . $openid->authUrl());
        exit();
    }
    if ($openid->validate()) {
        $ids = $openid->identity;
        $ptn = "/^https:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
        preg_match($ptn, $ids, $matches);

        if (!empty($matches[1])) {
            return $matches[1];
        }
    }
    return false;
}

$data = steamOauth();

if ($data !== false) {
    $GLOBALS['PDO']->query('SELECT aid, password FROM `:prefix_admins` WHERE authid = :authid');
    $GLOBALS['PDO']->bind(':authid', \SteamID\SteamID::toSteam2($data));
    $result = $GLOBALS['PDO']->single();
    if (count($result) == 2) {
        global $userbank;
        if (empty($result['password']) || $result['password'] == $userbank->encrypt_password('') || $result['password'] == $userbank->hash('')) {
            header("Location: ".SB_WP_URL."/index.php?p=login&m=empty_pwd");
            die;
        } else {
            session_destroy();
            \SessionManager::sessionStart('SourceBans', (60*60*24*7));
            $_SESSION['aid'] = $result['aid'];
        }
    }
} else {
    header("Location: ".SB_WP_URL."/index.php?p=login");
}
header("Location: ".SB_WP_URL);
