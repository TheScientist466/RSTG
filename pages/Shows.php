<?php include "../util/Database.php";
    $d = new Database();
    $d->connect();
    $result = $d->query("SELECT id, Name FROM rstg.productions ORDER BY ReleaseDate DESC");

    $titleStr = "";
    $nameRes = "No Record";
    $dirRes  = "No Record"; 
    $wriRes = "No Record";
    $langRes = "No Record";
    $relDateRes = "No Record"; 

    if(array_key_exists("Pr", $_GET)) {
        $pResult = $d->query("SELECT Name, Language, Director, Writer, ReleaseDate FROM rstg.productions WHERE id=" . $_GET["Pr"]);
        if($pResult->num_rows > 0) {
            $pRow = $pResult->fetch_assoc();
            $nameRes = $pRow["Name"] == NULL ? "No Record" : $pRow["Name"];
            $titleStr = $pRow["Name"] == NULL ? "" : ' - ' . $pRow["Name"];
            $relDateRes = $pRow["ReleaseDate"] == NULL ? "No Record" : $pRow["ReleaseDate"];
            if($pRow["Language"] != NULL) {
                $langRes = $d->query("SELECT language FROM rstg.language WHERE code='" . $pRow["Language"] . "'")->fetch_assoc()["language"];
            }
            if($pRow["Director"] != NULL)
                $dirRes = $d->query("SELECT Name FROM rstg.people WHERE ID=" . $pRow["Director"])->fetch_assoc()["Name"];
            if($pRow["Writer"] != NULL)
                $wriRes = $d->query("SELECT Name FROM rstg.people WHERE ID=" . $pRow["Writer"])->fetch_assoc()["Name"];
        }
    }
    
    $posterPath = '../res/Poster/' . strtolower(str_replace(' ', '-', $nameRes)) . '.png';
    $backdropPath = '../res/Backdrop/' . strtolower(str_replace(' ', '-', $nameRes)) . '.png';
    $posterPath = '"' . (file_exists($posterPath) ? $posterPath : '../res/Poster/not-found.gif') . '"';
    $backdropPath = (file_exists($backdropPath) ? $backdropPath : '../res/Backdrop/not-found.jpg');
?>

<html>
    <head>
        <title>Shows<?php echo $titleStr; ?></title>
        <link rel="stylesheet" href="../global/CSS/primary.css">
    </head>
    <body>

        <div class="full">
            <div class="back" <?php echo 'style="background-image: url(' . $backdropPath . ');"' ?>></div>
            
            <form action="./Shows.php" method="get">
                Production : 
                <select id="Pr" name="Pr">
                    <?php 
                        if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<option value=' . $row["id"] . '>' . $row["Name"] . '</option>';
                            }
                        }
                    ?>
                </select><br>
                <input type="submit">
            </form>
            <div style="postion: absolute; height: 100%; width: 100%;">
                <div class="blur panel center">
                    <div class="panel-title-container">
                        <h1 class="panel-title">Production</h1>
                    </div>
                    <div class="panel-content">
                        <div class="mid latest-prod-img-container">
                            <a href= <?php echo $posterPath; ?>>
                                <img title="Click to expand" src= <?php echo $posterPath; ?>  alt="Production Poster">
                            </a>
                        </div>
                        
                        <div class="prod-text-container">
                            <p>
                                <span class="des">Name: </span><?php echo $nameRes; ?><br><br>
                                <span class="des">Language: </span><?php echo $langRes; ?><br><br>
                                <span class="des">Director: </span><?php echo $dirRes; ?><br><br>
                                <span class="des">Writer: </span><?php echo $wriRes; ?><br><br>
                                <span class="des">Released on: </span><?php echo $relDateRes; ?><br><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>