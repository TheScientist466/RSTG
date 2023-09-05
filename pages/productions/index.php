<?php 
    include "../../util/Production.php";
    $d = new Database();
    $d->connect();
    $productions = $d->query("SELECT id, Name FROM rstg.productions ORDER BY ReleaseDate DESC");

    $titleStr = "";
    $relDateRes = "No Record"; 
    $prod = new Production();

    if(array_key_exists("Pr", $_GET)) {
        $prod->getById($_GET['Pr']);
        $titleStr = $prod->name;
    } else {
        $prod->getById(1);
        $titleStr = $prod->name;
    }
    
    $posterPath = '../../res/Poster/' . strtolower(str_replace(' ', '-', $prod->name)) . '.png';
    $backdropPath = '../../res/Backdrop/' . strtolower(str_replace(' ', '-', $prod->name)) . '.png';
    $posterPath = '"' . (file_exists($posterPath) ? $posterPath : '../../res/Poster/not-found.gif') . '"';
    $backdropPath = (file_exists($backdropPath) ? $backdropPath : '../../res/Backdrop/not-found.jpg');
?>

<html>
    <head>
        <title>Production - <?php echo $titleStr; ?></title>
        <link rel="stylesheet" href="../../global/CSS/primary.css">
        <link rel="stylesheet" href="../../global/CSS/navbar.css">
    </head>
    <body">

        <div class="navbar-container blur">
            <div class="navbar">
                <div><img class="logo" src="../../res/Logo_Vector.svg" alt="logo"></div>
                <div class="links">
                    <a class="link" href="http://localhost">Home</a>
                    <a class="link" href="./AboutUs.html">About Us</a>
                    <a class="link" href="#">Gallery</a>
                    <a class="link" href="./pages/productions">Productions</a>
                </div>
            </div>
        </div>

        <div style="height: 10vh;"></div>

        <div class="full">
            <div class="back" <?php echo 'style="background-image: url(' . $backdropPath . ');"' ?>></div>
            
            <form action="." method="get">
                Production : 
                <select id="Pr" name="Pr">
                    <?php 
                        if($productions->num_rows > 0) {
                            while($row = $productions->fetch_assoc()) {
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
                                <span class="des">Name: </span><?php echo $prod->name; ?><br><br>
                                <span class="des">Language: </span><?php echo $prod->lang; ?><br><br>
                                <span class="des">Director: </span><?php echo $prod->dir; ?><br><br>
                                <span class="des">Writer: </span><?php echo $prod->wri; ?><br><br>
                                <span class="des">Released on: </span><?php echo $relDateRes; ?><br><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>