<?php
    session_start();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <title>Luxurious Legacy Store</title>
</head>

<body>
    <nav id="nav">
        <?php include('navbar.php'); ?>
        <br><br>
        <div class="navBottom">
            <h3 class="menuItem">Watch</h3>
            <h3 class="menuItem">Necklace</h3>
            <h3 class="menuItem">Ring</h3>
            <h3 class="menuItem">Bangle</h3>
        </div>
    </nav>
    <div class="slider">
        <div class="sliderWrapper">
            <div class="sliderItem">
                <img src="./img/Diamond_Watch.png" alt="Diamond_Watch" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">ROLEX</br> WATCH</h1>
                <a href="products.php">
                    <button class="buyButton">BUY NOW!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="./img/Red_Necklace.png" alt="Red_Necklace" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">Harry</br> Winston</br> Necklace</h1>
                <a href="products.php">
                    <button class="buyButton">BUY NOW!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="./img/Diamond_Ring.png" alt="Diamond_Ring" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">Cartier</br> Ring</h1>
                <a href="products.php">
                    <button class="buyButton">BUY NOW!</button>
                </a>
            </div>
            <div class="sliderItem">
                <img src="./img/Diamond_Bangle.png" alt="Diamond_Bangle" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">Cartier</br> Bangle</h1>
                <a href="products.php">
                    <button class="buyButton">BUY NOW!</button>
                </a>
            </div>
        </div>
    </div>
   
    <div class="features">
        <div class="feature">
            <i class="bi bi-truck featureIcon" style="font-size: 40px;"></i>
            <span class="featureTitle">COMPLIMENTARY SHIPPING</span>
            <span class="featureDesc">Enjoy free worldwide shipping on all exclusive orders.</span>
        </div>
        <div class="feature">
            <i class="bi bi-arrow-repeat featureIcon" style="font-size: 40px;"></i>
            <span class="featureTitle">HASSLE-FREE RETURNS</span>
            <span class="featureDesc">Seamless 30-day returns with a swift refund process.</span>
        </div>
        <div class="feature">
            <i class="bi bi-gift featureIcon" style="font-size: 40px;"></i>
            <span class="featureTitle">LUXURY GIFTING</span>
            <span class="featureDesc">Exquisite gift packaging and exclusive gift cards available.</span>
        </div>
        <div class="feature">
            <i class="bi bi-envelope featureIcon" style="font-size: 40px;"></i>
            <span class="featureTitle">PERSONALIZED SUPPORT</span>
            <span class="featureDesc">Exclusive concierge service for your inquiries and orders.</span>
        </div>
    </div>
    

    <div class="gallery">
        <div class="galleryItem">
            <h1 class="galleryTitle">Timeless Elegance</h1>
            <img src="img/image_watch.png" alt="Luxury Watch" class="galleryImg">
        </div>
        <div class="galleryItem">
            <img src="img/image_necklace.png" alt="Exquisite Necklace" class="galleryImg">
            <h1 class="galleryTitle">Grace in Every Detail</h1>
        </div>
        <div class="galleryItem">
            <h1 class="galleryTitle">A Spark of Perfection</h1>
            <img src="img/image_ring.png" alt="Luxury Ring" class="galleryImg">
        </div>
    </div>
    

    <?php include('footer.php'); ?>

    <script src="./js/index.js"></script>
</body>

</html>
