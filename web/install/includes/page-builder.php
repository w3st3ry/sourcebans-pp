<?php

$_GET['step'] = isset($_GET['step']) ? $_GET['step'] : '1';

switch ($_GET['step']) {
    case "6":
        RewritePageTitle("Step 6 - AMXBans Import");
        $page = TEMPLATES_PATH . "/page.6.php";
        break;
    case "5":
        RewritePageTitle("Step 5 - Setup");
        $page = TEMPLATES_PATH . "/page.5.php";
        break;
    case "4":
        RewritePageTitle("Step 4 - Table Creation");
        $page = TEMPLATES_PATH . "/page.4.php";
        break;
    case "3":
        RewritePageTitle("Step 3 - System Requirements Check");
        $page = TEMPLATES_PATH . "/page.3.php";
        break;
    case "2":
        RewritePageTitle("Step 2 - Database Details");
        $page = TEMPLATES_PATH . "/page.2.php";
        break;
    default:
        RewritePageTitle("Step 1 - License agreement");
        $page = TEMPLATES_PATH . "/page.1.php";
        break;
}

require_once(TEMPLATES_PATH . "/header.php");
BuildPageTabs();
BuildSubMenu();
BuildContHeader();
if (!empty($page)) {
    include $page;
}
include_once(TEMPLATES_PATH . '/footer.php');
