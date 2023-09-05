<?php
include '../../util/Database.php';
$passw = 'ad4f0031ba052e6cf48e799e5b318d0ceafb4247e569f97467c51c46d4927c9f';
if(hash('sha256', $_POST['passwd']) == $passw) { 
    if(strlen($_POST['name']) > 0) {
        $d = new Database();
        $d->connectWithAdminPasswd($_POST['passwd']);
        $idRes = $d->query('SELECT id FROM rstg.productions ORDER BY id DESC LIMIT 1');
        $id;
        if($idRes->num_rows > 0) {
            $id = $idRes->fetch_assoc()['id'] + 1;
        } else  {
            $id = 0;
        }
        $qr = sprintf('INSERT INTO rstg.productions (id, Name, Language, Director, Writer) VALUES (%d, "%s", "%s", %d, %d)', $id, $_POST['name'], $_POST['Lng'], $_POST['Dir'], $_POST['Wri']);
        //echo $qr;
        $d->query($qr);
        echo 'yay';
    } else {
        echo 'INVALID NAME';
    }
} else {
    echo 'INVALID PASSWORD';
}
?>