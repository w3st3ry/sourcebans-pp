<?php

global $theme;

$admin_list = $GLOBALS['db']->GetAll("SELECT * FROM `" . DB_PREFIX . "_admins` ORDER BY user ASC");
$theme->assign('admin_list', $admin_list);

$theme->display('box_admin_log_search.tpl');
