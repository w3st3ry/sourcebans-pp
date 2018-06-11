<?php

global $userbank, $theme;
if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}
if (isset($GLOBALS['IN_ADMIN'])) {
    define('CUR_AID', $userbank->GetAid());
}


if (isset($_GET["rebanid"])) {
    echo '<script type="text/javascript">xajax_PrepareReblock("' . $_GET["rebanid"] . '");</script>';
} elseif (isset($_GET["blockfromban"])) {
    echo '<script type="text/javascript">xajax_PrepareBlockFromBan("' . $_GET["blockfromban"] . '");</script>';
} elseif ((isset($_GET['action']) && $_GET['action'] == "pasteBan") && isset($_GET['pName']) && isset($_GET['sid'])) {
    echo "<script type=\"text/javascript\">ShowBox('Loading..','<b>Loading...</b><br><i>Please Wait!</i>', 'blue', '', true);document.getElementById('dialog-control').setStyle('display', 'none');xajax_PasteBlock('" . (int) $_GET['sid'] . "', '" . addslashes($_GET['pName']) . "');</script>";
}

echo '<div id="admin-page-content">';
// Add Block
echo '<div id="0" style="display:none;">';
$theme->assign('permission_addban', $userbank->HasAccess(ADMIN_OWNER | ADMIN_ADD_BAN));
$theme->display('page_admin_comms_add.tpl');
?>
</div>
<script type="text/javascript">
function changeReason(szListValue)
{
    $('dreason').style.display = (szListValue == "other" ? "block" : "none");
}
function ProcessBan()
{
    var reason = $('listReason')[$('listReason').selectedIndex].value;

    if (reason == "other") {
        reason = $('txtReason').value;
    }
    xajax_AddBlock($('nickname').value,
        $('type').value,
        $('steam').value,
        $('banlength').value,
        reason
    );
}
</script>
</div>
