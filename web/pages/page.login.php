<?php

if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}
RewritePageTitle("Admin Login");

global $userbank, $theme;
$submenu = array(
    array(
        "title" => 'Lost Your Password?',
        "url" => 'index.php?p=lostpassword'
    )
);
SubMenu($submenu);
if (isset($_GET['m'])) {
    switch ($_GET['m']) {
        case 'no_access':
            echo <<<HTML
				<script>
					ShowBox(
						'Error - No Access',
						'You dont have permission to access this page.<br />' +
						'Please login with an account that has access.',
						'red', '', false
					);
				</script>
HTML;
            break;

        case 'empty_pwd':
            $lostpassword_url = SB_WP_URL . '/index.php?p=lostpassword';
            echo <<<HTML
				<script>
					ShowBox(
						'Information',
						'You are unable to login because your account have an empty password set.<br />' +
						'Please <a href="$lostpassword_url">restore your password</a> or ask an admin to do that for you.<br />' +
						'Do note that you are required to have a non empty password set event if you sign in through Steam.',
						'blue', '', true
					);
				</script>
HTML;
            break;
    }
}

$steam_conf_value = get_steamenabled_conf($confvalue);
$theme->assign('steamlogin_show', $steam_conf_value);
$theme->assign('redir', "DoLogin('" . (isset($_SESSION['q']) ? $_SESSION['q'] : '') . "');");
$theme->left_delimiter  = "-{";
$theme->right_delimiter = "}-";
$theme->display('page_login.tpl');
$theme->left_delimiter  = "{";
$theme->right_delimiter = "}";
