<?php

global $userbank, $theme, $xajax, $user, $start;
$time  = microtime();
$time  = explode(" ", $time);
$time  = $time[1] + $time[0];
$start = $time;
ob_start();

if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}

if (isset($_GET['c']) && $_GET['c'] == "settings") {
    $theme->assign('tiny_mce_js', '<script type="text/javascript" src="./includes/tinymce/tinymce.min.js"></script>
					<script language="javascript" type="text/javascript">
					tinyMCE.init({
						selector: "textarea",
                        height: 500,
						theme : "modern",
						plugins : "advlist, autolink, lists, link, image, charmap, print, preview, hr, anchor, pagebreak, searchreplace, wordcount, visualblocks, visualchars, code, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, template, paste, textcolor, colorpicker, textpattern, imagetools, codesample, toc",
						extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
					});
					</script>');
} else {
    $theme->assign('tiny_mce_js', '');
}

$theme->assign('xajax_functions', $xajax->printJavascript("scripts", "xajax.js"));
$theme->assign('header_title', $GLOBALS['config']['template.title']);
$theme->assign('header_logo', $GLOBALS['config']['template.logo']);
$theme->assign('username', $userbank->GetProperty("user"));
$theme->assign('logged_in', $userbank->is_logged_in());
$theme->assign('theme_name', isset($GLOBALS['config']['config.theme']) ? $GLOBALS['config']['config.theme'] : 'default');
$theme->display('page_header.tpl');
