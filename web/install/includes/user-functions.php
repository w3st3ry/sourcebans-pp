<?php

global $user, $db;
/**
 * Checks the database for any identical
 * rows, username, email etc
 *
 * @param string $table the table to lookup
 * @param string $field The feild to check
 * @param string $value The value to check against
 * @return true if the value already exists in that field is found, else false
 */
function is_taken($table, $field, $value)
{
    $GLOBALS['db']->query('SELECT * FROM `:prefix_:table` WHERE `:field` = `:value`');
    $GLOBALS['db']->bind(':table', $table);
    $GLOBALS['db']->bind(':field', $field);
    $GLOBALS['db']->bind(':value', $value);
    $result = $GLOBALS['db']->resultset();
    return (count($result) > 0);
}

/**
 * Returns the current flags associated with the user
 *
 * @param integer The admin id to check
 * @return integer.
 */
function get_user_flags($aid)
{
    if (empty($aid)) {
        return 0;
    }

    $GLOBALS['db']->query('SELECT `gid`, `extraflags` FROM `:prefix_admins` WHERE `aid` = `:aid`');
    $GLOBALS['db']->bind(':aid', $aid);
    $admin = $GLOBALS['db']->single();

    if (intval($admin['gid']) === -1) {
        return intval($admin['extraflags']);
    }

    $GLOBALS['db']->query('SELECT `flags` FROM `:prefix_groups` WHERE `gid` = `:gid`');
    $GLOBALS['db']->bind(':gid', $admin['gid']);
    $group = $GLOBALS['db']->single();
    return (intval($group['flags']) | intval($admin['extraflags']));
}

/**
 * Returns the current server flags associated with the user
 *
 * @param string The admin to check
 * @return string.
 */
function get_user_admin($steam)
{
    if (empty($steam)) {
        return 0;
    }
    $GLOBALS['db']->query('SELECT * FROM `:prefix_srvadmins` WHERE `identity` = `:identity`');
    $GLOBALS['db']->bind(':identity', $steam);
    $admin = $GLOBALS['db']->single();

    if (strlen($admin['groups']) > 1) {
        $GLOBALS['db']->query('SELECT `flags` FROM `:prefix_srvgroups` WHERE `name` = `:name`');
        $GLOBALS['db']->bind(':name', $admin['groups']);
        $query = $GLOBALS['db']->single();
        return $query['flags'] . $admin['flags'];
    }
    return $admin['flags'];
}

/**
 * Returns the current server flags associated with the user
 *
 * @param string The admin to check
 * @return string.
 */
function get_non_inherited_admin($steam)
{
    if (empty($steam)) {
        return 0;
    }
    $GLOBALS['db']->query('SELECT * FROM `:prefix_srvadmins` WHERE `identity` = `:identity`');
    $GLOBALS['db']->bind(':identity', $steam);
    $admin = $GLOBALS['db']->single();
    return $admin['flags'];
}

/**
 * Checks if user is logged in.
 *
 * @return boolean.
 */
function is_logged_in()
{
    if ($_SESSION['user']['user'] == "Guest" || $_SESSION['user']['user'] == "") {
        return false;
    }
    return true;
}

/**
 * Checks if user is an admin.
 *
 * @return boolean.
 */
function is_admin($aid)
{
    if (check_flags($aid, ALL_WEB)) {
        return true;
    }
    return false;
}

/**
 * Checks if the admin has ANY the specified flags
 *
 * @param integet $aid the admin id to check the flags of
 * @param integer $flag the flag to check
 * @return boolean
 */
function check_flags($aid, $flag)
{
    $mask = get_user_flags($aid);
    if (($mask & $flag) !=0) {
        return true;
    }
    return false;
}

/**
 * Checks if the mask contains ANY the specified flags
 *
 * @param integet $aid the admin id to check the flags of
 * @param integer $flag the flag to check
 * @return boolean
 */
function check_flag($mask, $flag)
{
    if (($mask & $flag) !=0) {
        return true;
    }
    return false;
}

function validate_steam($steam)
{
    if (preg_match(STEAM_FORMAT, $steam)) {
        return true;
    }
    return false;
}

function validate_email($email)
{
    if (preg_match(EMAIL_FORMAT, $email)) {
        return true;
    }
    return false;
}
