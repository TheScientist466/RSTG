<?php
include 'Database.php';

class Production {
    public $name;
    public $dir;
    public $wri;
    public $lang;
    public $relDate;
    private $d;

    public function __construct() {
        $this->d = new Database();
        $this->d->connect();
        $this->name = 'No Record';
        $this->dir = 'No Record';
        $this->wri = 'No Record';
        $this->lang = 'No Record';
        $this->relDate = 'No Record';
    }

    public function __destruct() {

    }

    public function getById($Id) {
        $prodRes = $this->d->query("SELECT Name, Language, Director, Writer, ReleaseDate FROM rstg.productions WHERE id=" . $Id);
        if($prodRes->num_rows > 0) {
            $prod = $prodRes->fetch_assoc();

            $this->name = $prod['Name'] == NULL ? 'No Record' : $prod['Name'];

            if($prod["Director"] != NULL)
                $this->dir = $this->d->query("SELECT Name FROM rstg.people WHERE ID=" . $prod["Director"])->fetch_assoc()['Name'];
 
            if($prod["Writer"] != NULL)
                $this->wri = $this->d->query("SELECT Name FROM rstg.people WHERE ID=" . $prod["Writer"])->fetch_assoc()['Name'];

            if($prod["Language"] != NULL)
                $this->lang = $this->d->query("SELECT language FROM rstg.language WHERE code='" . $prod["Language"] . "'")->fetch_assoc()["language"];
        }
    }

    public function getLatest() {
        $this->getById($this->d->query('SELECT id FROM rstg.productions ORDER BY ReleaseDate DESC')->fetch_assoc()['id']);
    }
}
?>