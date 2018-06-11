<?php

include_once("../init.php");
include_once("../includes/system-functions.php");
global $theme, $userbank;

if (!$userbank->HasAccess(ADMIN_OWNER | ADMIN_ADD_BAN | ADMIN_EDIT_OWN_BANS | ADMIN_EDIT_GROUP_BANS | ADMIN_EDIT_ALL_BANS)) {
    Log::add("w", "Hacking Attempt", $userbank->GetProperty('user')." tried to upload a demo, but doesn't have access.");
    die("You don't have access to this!");
}

$message = "";

if (isset($_POST['upload'])) {
    if (CheckExt($_FILES['demo_file']['name'], "zip") || CheckExt($_FILES['demo_file']['name'], "rar") || CheckExt($_FILES['demo_file']['name'], "dem") || CheckExt($_FILES['demo_file']['name'], "7z") || CheckExt($_FILES['demo_file']['name'], "bz2") || CheckExt($_FILES['demo_file']['name'], "gz")) {
        $filename = md5(time() . rand(0, 1000));
        move_uploaded_file($_FILES['demo_file']['tmp_name'], SB_DEMOS . "/" . $filename);
        $message = "<script>window.opener.demo('" . $filename . "','" . $_FILES['demo_file']['name'] . "');self.close()</script>";
        Log::add("m", "Demo Uploaded", "A new demo has been uploaded: $_FILES[demo_file][name]");
    } else {
        $message = "<b> File must be dem, zip, rar, 7z, bz2 or gz filetype.</b><br><br>";
    }
}

$theme->assign("title", "Upload Demo");
$theme->assign("message", $message);
$theme->assign("input_name", "demo_file");
$theme->assign("form_name", "demup");
$theme->assign("formats", "a DEM, ZIP, RAR, 7Z, BZ2 or GZ");

$theme->display('page_uploadfile.tpl');
