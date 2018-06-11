<?php

include_once("../init.php");
include_once("../includes/system-functions.php");
global $theme, $userbank;

if (!$userbank->HasAccess(ADMIN_OWNER | ADMIN_ADD_SERVER)) {
    Log::add("w", "Hacking Attempt", $userbank->GetProperty('user')." tried to upload a mapimage, but doesn't have access.");
    die("You don't have access to this!");
}

$message = "";
if (isset($_POST['upload'])) {
    if (CheckExt($_FILES['mapimg_file']['name'], "jpg")) {
        move_uploaded_file($_FILES['mapimg_file']['tmp_name'], SB_MAP_LOCATION . "/" . $_FILES['mapimg_file']['name']);
        $message = "<script>window.opener.mapimg('" . $_FILES['mapimg_file']['name'] . "');self.close()</script>";
        Log::add("m", "Map Image Uploaded", "A new map image has been uploaded: $_FILES[mapimg_file][name]");
    } else {
        $message = "<b> File must be jpg filetype.</b><br><br>";
    }
}

$theme->assign("title", "Upload Mapimage");
$theme->assign("message", $message);
$theme->assign("input_name", "mapimg_file");
$theme->assign("form_name", "mapimgup");
$theme->assign("formats", "a JPG");

$theme->display('page_uploadfile.tpl');
