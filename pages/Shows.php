<?php include "../util/Database.php";
    $d = new Database();
    $d->connect();
    $result = $d->query("SELECT id, Name FROM rstg.productions ORDER BY ReleaseDate DESC");

    $titleStr = "";
    $nameRes = "No Record";
    $dirRes  = "No Record"; 
    $wriRes = "No Record";
    $relDateRes = "No Record"; 

    if(array_key_exists("Pr", $_POST)) {
        $pResult = $d->query("SELECT Name, Director, Writer, ReleaseDate FROM rstg.productions WHERE id=" . $_POST["Pr"]);
        if($pResult->num_rows > 0) {
            $pRow = $pResult->fetch_assoc();
            $nameRes = $pRow["Name"] == NULL ? "No Record" : $pRow["Name"];
            $titleStr = $pRow["Name"] == NULL ? "" : ' - ' . $pRow["Name"];
            $relDateRes = $pRow["ReleaseDate"] == NULL ? "No Record" : $pRow["ReleaseDate"];
            if($pRow["Director"] != NULL)
                $dirRes = $d->query("SELECT Name FROM rstg.people WHERE ID=" . $pRow["Director"])->fetch_assoc()["Name"];
            if($pRow["Director"] != NULL)
                $wriRes = $d->query("SELECT Name FROM rstg.people WHERE ID=" . $pRow["Writer"])->fetch_assoc()["Name"];
        }
    }
    $posterPath = '../res/Poster/' . strtolower(str_replace(' ', '-', $nameRes)) . '.png';
    $posterPath = '"' . (file_exists($posterPath) ? $posterPath : '../res/Poster/not-found.gif') . '"';
?>

<html>
    <head>
        <title>Shows<?php echo $titleStr; ?></title>
        <link rel="stylesheet" href="../global/CSS/primary.css">
    </head>
    <body>
        <form action="./Shows.php" method="post">
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

        

        <div class="full">
            <div class="back" style="background-image: url(../res/Latest_Prod_backdrop.JPG);"></div>
            <div class="blur panel mid center">
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
                            <span class="des">Director: </span><?php echo $dirRes; ?><br><br>
                            <span class="des">Writer: </span><?php echo $wriRes; ?><br><br>
                            <span class="des">Released on: </span><?php echo $relDateRes; ?><br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>