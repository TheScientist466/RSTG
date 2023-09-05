<?php 
include '../../util/Database.php';

$d = new Database();
$d->connect();

class Production {
	public $id;
    public $Name;
    public $Dir;
    public $Wri;
    public $Lng;
}

$p = new Production;
$pResR = $d->query('SELECT id, Name, Director, Writer, Language FROM rstg.productions WHERE id='. $_POST['id']);
if($pResR->num_rows > 0) {
    $pRes = $pResR->fetch_assoc();
    $p->id = $pRes['id'];
    $p->Name = $pRes['Name'];
    $p->Dir = $pRes['Director'];
    $p->Wri = $pRes['Writer'];
    $p->Lng = $pRes['Language'];

    echo json_encode($p);
} else {
    echo "BRUH";
}
?>