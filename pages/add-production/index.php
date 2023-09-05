<?php
include '../../util/Database.php';

$d = new Database();
$d->connect();

class Person {
    public $id;
    public $name;
}

class Language {
    public $code;
    public $lng;
}

class Production {
    public $id;
    public $Name;
}

$peopleRes = $d->query('SELECT id, Name FROM rstg.people ORDER BY Name ASC');
$people = array();
if($peopleRes->num_rows > 0) {
    while($p = $peopleRes->fetch_assoc()) {
        $per = new Person();
        $per->name = $p['Name'];
        $per->id = $p['id'];
        array_push($people, $per);
    }
}

$langRes = $d->query('SELECT code, language FROM rstg.language ORDER BY language');
$languages = array();
if($langRes->num_rows > 0) {
    while($l = $langRes->fetch_assoc()) {
        $lng = new Language();
        $lng->code = $l['code'];
        $lng->lng = $l['language'];
        array_push($languages, $lng);
    }
}

$prodRes = $d->query('SELECT id, Name, Director, Writer FROM rstg.productions ORDER BY id');
$prods = array();
if($prodRes->num_rows > 0) {
    while($p = $prodRes->fetch_assoc()) {
        $prod = new Production();
        $prod->id = $p['id'];
        $prod->Name = $p['Name'];
        array_push($prods, $prod);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Production</title>
        <link rel="stylesheet" href="add-prod.css">
        <link rel="stylesheet" href="select-content.css">
    </head>
    <body>
        <div class='main-content'>
            <div class="panel-cover passwd-panel">
                <div class="passwd-box">
                    <div class="passwd-stuff">
                        <input class="passwd-area" type="password" name="passwd" placeholder="Password">
                        <div class="passwd-buttons">
                            <input id="form-submit" type="submit" value="Send">
                            <input class="toggle-passwd-panel" type="button" value="Cancel">
                        </div>
                    </div>
                </div>
            </div>
            <form id="add-prod" action='add-prod.php' method='POST' onsubmit='submitScript(this)'>
                <div class="panel-cover passwd-panel">
                    <div class="passwd-box">
                        <div class="passwd-stuff">
                            <input class="passwd-area" type="password" name="passwd" placeholder="Password">
                            <div class="passwd-buttons">
                                <input type="submit" value="Send">
                                <input class="toggle-passwd-panel" type="button" value="Cancel">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-content">
                    <h2>Add Production</h2>
                    <h3>Name</h3>
                    <input name="name" placeholder="Name of Production"><br>
                    <h3>Director</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Director</span>
                        </div>
                        <div class="content">
                            <ol class="options">
                                <?php 
                                for($i = 0; $i < sizeof($people); $i++) {
                                    echo '<li class="option" data-val="' . $people[$i]->id . '" onclick="sel(this)">' . $people[$i]->name . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='Dir'>
                        </div>
                    </div>
                    <h3>Writer</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Writer</span>
                        </div>
                        <div class="content">
                            <ol class="options">
                                <?php 
                                for($i = 0; $i < sizeof($people); $i++) {
                                    echo '<li class="option" data-val="' . $people[$i]->id . '" onclick="sel(this)">' . $people[$i]->name . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='Wri'>
                        </div>
                    </div>

                    <h3>Language</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Language</span>
                        </div>
                        <div class="content">
                            <ol class="options">
                                <?php 
                                for($i = 0; $i < sizeof($languages); $i++) {
                                    echo '<li class="option" data-val="' . $languages[$i]->code . '" onclick="sel(this)">' . $languages[$i]->lng . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='Lng'>
                        </div>
                    </div>
                    <input class='val-encoder passwd-container' name='passwd'>
                    <input class="toggle-passwd-panel" type='button' value='Add'>
                </div>
            </form>

            <form id="edit-prod" action='edit-prod.php' method='POST' onsubmit='submitScript(this)'>
                <div class="form-content">
                    <h2>Edit Production</h2>
                    <h3>Name</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Name</span>
                        </div>
                        <div class="content">
                            <ol id="prod-names" class="options">
                                <?php 
                                for($i = 0; $i < sizeof($prods); $i++) {
                                    echo '<li class="option" data-val="' . $prods[$i]->id . '" onclick="selAndGetProd(this)">' . $prods[$i]->Name . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='id'>
                        </div>
                    </div>
                    <h3>Edit Name<h3>
                    <input name="name" placeholder="Name of Production"><br>
                    <h3>Director</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Director</span>
                        </div>
                        <div class="content">
                            <ol class="options">
                                <li class="option" data-val="-1" onclick="sel(this)">NULL</li>
                                <?php 
                                for($i = 0; $i < sizeof($people); $i++) {
                                    echo '<li class="option" data-val="' . $people[$i]->id . '" onclick="sel(this)">' . $people[$i]->name . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='Dir'>
                        </div>
                    </div>
                    <h3>Writer</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Writer</span>
                        </div>
                        <div class="content">
                            <ol class="options">
                                <li class="option" data-val="-1" onclick="sel(this)">NULL</li>
                                <?php 
                                for($i = 0; $i < sizeof($people); $i++) {
                                    echo '<li class="option" data-val="' . $people[$i]->id . '" onclick="sel(this)">' . $people[$i]->name . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='Wri'>
                        </div>
                    </div>

                    <h3>Language</h3>
                    <div class="select-dropdown-container">
                        <div class="select-btn">
                            <span class='sel-name'>Select Language</span>
                        </div>
                        <div class="content">
                            <ol class="options">
                                <li class="option" data-val="-1" onclick="sel(this)">NULL</li>
                                <?php 
                                for($i = 0; $i < sizeof($languages); $i++) {
                                    echo '<li class="option" data-val="' . $languages[$i]->code . '" onclick="sel(this)">' . $languages[$i]->lng . '</li>' . "\n";
                                }
                                ?>
                            </ol>
                            <input class='val-encoder' name='Lng'>
                        </div>
                    </div>
                    <input class='val-encoder passwd-container' name='passwd'>
                    <input class="toggle-passwd-panel" type='button' value='Edit'>
                </div>
            </form>
            <script src="select-content.js"></script>
            <script src="get-prod.js"></script>
        </div>
    </body>
</html>