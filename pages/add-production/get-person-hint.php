<?php
include '../../util/Database.php';
$d = new Database();
$d->connect();

if(array_key_exists('name', $_POST)) {
    $res = $d->query("SELECT Name FROM rstg.people WHERE Name LIKE '" . $_POST['name'] . "%'");
    if($res->num_rows > 0) {
        $nameRes = $res->fetch_assoc()['Name'];
        echo $nameRes;
    } else {
        echo NULL;
        return;
    }
} else  {
    echo NULL;
    return;
}
?>