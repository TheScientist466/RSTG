<?php include "util/Database.php";
    $d = new Database();
    $d->connect();
    $result = $d->query("SELECT id, Name, Director, Writer, ReleaseDate FROM rstg.productions ORDER BY ReleaseDate DESC");

    $nameRes = "No Record";
    $dirRes  = "No Record"; 
    $wriRes = "No Record";
    $relDateRes = "No Record"; 

    $pResult = $result;
    if($pResult->num_rows > 0) {
        $pRow = $pResult->fetch_assoc();
        $nameRes = $pRow["Name"] == NULL ? "No Record" : $pRow["Name"];
        $relDateRes = $pRow["ReleaseDate"] == NULL ? "No Record" : $pRow["ReleaseDate"];
        if($pRow["Director"] != NULL)
            $dirRes = $d->query("SELECT Name FROM rstg.people WHERE ID=" . $pRow["Director"])->fetch_assoc()["Name"];
        if($pRow["Director"] != NULL)
            $wriRes = $d->query("SELECT Name FROM rstg.people WHERE ID=" . $pRow["Writer"])->fetch_assoc()["Name"];
    }
    $posterPath = './res/Poster/' . strtolower(str_replace(' ', '-', $nameRes)) . '.png';
    $backdropPath = './res/Backdrop/' . strtolower(str_replace(' ', '-', $nameRes)) . '.png';
    $posterPath = '"' . (file_exists($posterPath) ? $posterPath : './res/Poster/not-found.gif') . '"';
    $backdropPath = (file_exists($backdropPath) ? $backdropPath : './res/Poster/not-found.gif');
    
?>

<html>
    <head>
        <link rel="stylesheet" href="./global/CSS/primary.css">
        <title>Rang Sanskar Theatre Group, India</title>
    </head>
    <body>
        <! navbar>
        <div class="navbar-container blur">
            <div class="navbar">
                <div><img class="logo" src="./res/Logo_Vector.svg" alt="logo"></div>
                <div class="links">
                    <a class="link" href="#">Home</a>
                    <a class="link" href="./AboutUs.html">About Us</a>
                    <a class="link" href="#">Gallery</a>
                    <a class="link" href="./pages/Shows.php">Productions</a>
                </div>
            </div>
        </div>
        <!/navbar>

        <!s1>
        <div class="back" style="background-image: url(./res/IMG_1696.JPG);"></div>
        <div class="full-t">
            <h1 id="main-heading">Immerse yourself in the world of theatre</h1>
        </div>

        <div class="what-we-do-container">
            <div class="what-we-do-title">
                <h1>What we do</h1>
            </div>
            <div class="what-we-do-content">
                <div class="what-we-do">
                    <div>
                        <img src="./res/mask.png">
                        <h2>drama</h2>
                    </div>
                </div>
                <div class="what-we-do">
                    <div>
                        <img src="./res/mask.png">
                        <h2>festival</h2>
                    </div>
                </div>
                <div class="what-we-do">
                    <div>
                        <img src="./res/mask.png">
                        <h2>stuff</h2>
                    </div>
                </div>
            </div>
        </div>

        <!s2>
        <div class="full">
            <div class="back" style="background-image: url(./res/Latest_Prod_backdrop.JPG);"></div>
            <div class="blur panel mid center">
                <div class="panel-title-container">
                    <h1 class="panel-title">Latest Production</h1>
                </div>
                <div class="panel-content">
                    <div class="mid latest-prod-img-container">
                        <a href= <?php echo $posterPath; ?>>
                            <img title="Click to expand" src= <?php echo $posterPath; ?>  alt="Production Poster">
                        </a>
                    </div>
                    
                    <div class="prod-text-container">
                        <p>
                            <span class="des">Name:</span> <?php echo $nameRes; ?><br><br>
                            <span class="des">Director:</span> <?php echo $dirRes; ?><br><br>
                            <span class="des">Playwright:</span> <?php echo $wriRes; ?><br><br>
                            <span class="des">Release Date:</span> <?php echo $relDateRes; ?><br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="social-media-container">
                <a href="https://www.facebook.com/groups/1554074094884741/">
                    <img class="social-media" src="./res/mask.png" alt="facebook">
                </a>
                <a href="#">
                    <img class="social-media" src="./res/mask.png" alt="facebook">
                </a>
                <a href="#">
                    <img class="social-media" src="./res/mask.png" alt="facebook">
                </a>
            </div>
        </div>
    </body>
</html>