<?php
include '../../util/Database.php';
$passw = 'ad4f0031ba052e6cf48e799e5b318d0ceafb4247e569f97467c51c46d4927c9f';
if(hash('sha256', $_POST['passwd']) == $passw) {
    $d = new Database();
    $d->connectWithAdminPasswd($_POST['passwd']);
    if(!array_key_exists('id', $_POST) || !array_key_exists('name', $_POST)) {
        echo 'INVALID ID or Name';
    } else {
        $dirCmd = sprintf(", Director=%d", $_POST['Dir']);
        $wriCmd = sprintf(", Writer=%d", $_POST['Wri']);
        $lngCmd = sprintf(", Language=\"%s\"", $_POST['Lng']);

        if($_POST['Dir'] == 0 || $_POST['Dir'] == "") {
            $dirCmd = NULL;
        }
        if($_POST['Wri'] == 0 || $_POST['Wri'] == "") {
            $wriCmd = NULL;
        }
        if($_POST['Lng'] == NULL || $_POST['Lng'] == "") {
            $lngCmd = NULL;
        }

        $qr = sprintf("UPDATE rstg.productions SET Name=\"%s\"%s%s%s WHERE id=%d", $_POST['name'], $dirCmd, $wriCmd, $lngCmd, $_POST['id']);
        echo $qr;
        $d->query($qr);
    }
} else {
    echo 'INVALID PASSWORD';
}
?>