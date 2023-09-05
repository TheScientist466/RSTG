

<?php
include '../../util/Database.php';

if(array_key_exists('personName', $_POST)) {
    $d = new Database();
    $d->connect();

    $d->query('INSERT INTO rstg.people (Name) VALUES ("' . $_POST['personName'] . '")'); 
    echo "<script>window.location = 'index.php'</script>";

} else {
    echo 'unsuccessful';
}
?>