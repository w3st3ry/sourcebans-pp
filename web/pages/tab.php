<?php

global $theme;
if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}
$theme->assign('active', (bool) $tabs['active']);
$theme->assign('tab_link', CreateLinkR($tabs['title'], $tabs['url'], $tabs['desc']));
$theme->display('tab.tpl');
