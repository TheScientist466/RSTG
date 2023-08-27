<?php 
    include 'util/Production.php';
    $prod = new Production();
    $prod->getLatest();

    $posterPath = './res/Poster/' . strtolower(str_replace(' ', '-', $prod->name)) . '.png';
    $backdropPath = './res/Backdrop/' . strtolower(str_replace(' ', '-', $prod->name)) . '.png';
    $posterPath = '"' . (file_exists($posterPath) ? $posterPath : './res/Poster/not-found.gif') . '"';
    $backdropPath = (file_exists($backdropPath) ? $backdropPath : './res/Backdrop/not-found.jpg');
    $homePath = './res/Backdrop/bhorer-aashay.png';
    $homePath = (file_exists($homePath) ? $homePath : './res/Backdrop/not-found.jpg');
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./global/CSS/primary.css">
        <link rel="stylesheet" href="./global/CSS/navbar.css">
        <link rel="stylesheet" href="./global/CSS/cards.css">
        <link rel="stylesheet" href="./global/CSS/footer.css">
        <link rel="icon" type="image/x-icon" href="./res/main-icon.ico">
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
                    <a class="link" href="./pages/productions">Productions</a>
                </div>
            </div>
        </div>
        <!/navbar>
        
        <!s1>
        <div class="back" <?php echo 'style="background-image: url(' . $homePath . ');"' ?>></div>
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
            <div class="back" <?php echo 'style="background-image: url(' . $backdropPath . ');"' ?>></div>
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
                            <span class="des">Name:</span> <?php echo $prod->name; ?><br><br>
                            <span class="des">Director:</span> <?php echo $prod->dir; ?><br><br>
                            <span class="des">Playwright:</span> <?php echo $prod->wri; ?><br><br>
                            <span class="des">Release Date:</span> <?php echo $prod->relDate; ?><br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="festival-card-backdrop" class="back"></div>
        <div id="festival-card-backdrop-overlay" class="back"><h1 style="color: white;">Festivals</h1></div>
        <div class="festival-card-container">
            <input type="button" id="left-but" class="button" value="<">
            <div class="gallery">
                <div class="gallery-container">
                    <img class="gallery-item gallery-item-1" src="./res/festival-cards/img_1.png">
                    <img class="gallery-item gallery-item-2" src="./res/festival-cards/img_2.png">
                    <img class="gallery-item gallery-item-3" src="./res/festival-cards/img_3.png">
                    <img class="gallery-item gallery-item-4" src="./res/festival-cards/img_4.png">
                    <img class="gallery-item gallery-item-5" src="./res/festival-cards/img_5.png">
                    <img class="gallery-item" src="./res/festival-cards/img_6.png">
                </div>
            </div>
            <input type="button" id="right-but" class="button" value=">">
        </div>
        
        <script src="./global/js/cards.js"></script>

        <div class="footer">
            <div class="social-media-container">
                <a href="https://www.facebook.com/groups/1554074094884741/">
                    <img class="social-media" src="./res/social-media-icons/facebook.svg" alt="facebook">
                </a>
                <a href="https://www.instagram.com/rangsanskartheatregroup/">
                    <img class="social-media" src="./res/social-media-icons/instagram.svg" alt="instagram">
                </a>
                <a href="https://www.youtube.com/channel/UC16U8N81lSOpqUfbRe9La6Q">
                    <img class="social-media" src="./res/social-media-icons/youtube.svg" alt="youtube">
                </a>
            </div>
        </div>
    </body>
</html>