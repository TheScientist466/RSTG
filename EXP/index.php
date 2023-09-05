<?php
include '../util/Database.php';

$d = new Database();
$d->connect();
$peopleRes = $d->query('SELECT Name FROM rstg.people ORDER BY id ASC');
$people = array();
if($peopleRes->num_rows > 0) {
    while($p = $peopleRes->fetch_assoc()) {
        array_push($people, $p['Name']);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>hello</title>
        <link rel="stylesheet" href="select-content.css">
    </head>
    <body>
        <form action='test.php' method='POST'>
            <div class="select-dropdown-container">
                <div class="select-btn">
                    <span class='sel-name'>Select</span>
                </div>
                <div class="content">
                    <ol class="options">
                        <?php 
                        for($i = 0; $i < sizeof($people); $i++) {
                            echo '<li class="option" value="' . $i . '" onclick="sel(this)">' . $people[$i] . '</li>';
                        }
                        ?>
                    </ol>
                    <input class='val-encoder' name='bre'>
                </div>
            </div>
            <input type='submit'>
        </form>

        <!-- <div class="select-dropdown-container">
            <div class="select-btn">
                <span class='sel-name'>Select</span>
            </div>
            <div class="content">
                <div class="search">
                    <input type="text" placeholder="Search">
                </div>
                <ul class="options">
                    <?php 
                    for($i = 0; $i < sizeof($people); $i++) {
                        echo '<li class="option" onclick="sel(this, ' . $i . ')">' . $people[$i] . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div> -->
        <script src="srcipt.js"></script>
    </body>
</html>