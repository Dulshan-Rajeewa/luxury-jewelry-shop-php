<?php
    session_start();
    include("config.php");

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please log in to add items to the cart.'); window.location.href='login.php';</script>";
    }

    $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/StylesProducts.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="img/logo.png" type="image/icon type">
</head>
<body>
    <nav id="nav">
        <?php include('navbar.php'); ?>
    </nav>
    <br><br>

    <div class="products-container">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="product">
                <div class="product-image">
                    <img src="'.$row['product_image_url'].'" alt="'.$row['product_name'].'" class="product-img">
                </div>
                <div class="product-details">
                    <h1 class="product-title">'.$row['product_name'].'</h1>
                    <h2 class="product-price">$'.$row['product_price'].'</h2>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                        <button type="submit" class="add-to-cart">Add to Cart</button>
                    </form>
                    <button class="buy-now" onclick="openPayment()">Buy Now</button>
                </div>
            </div>';
        }
        ?>
    </div>
    
    <div class="payment">
        <h1 class="payTitle">Personal Information</h1>
        <label>Name and Surname</label>
        <input type="text" placeholder="John Doe" class="payInput">
        <label>Phone Number</label>
        <input type="text" placeholder="+1 234 5678" class="payInput">
        <label>Address</label>
        <input type="text" placeholder="Elton St 21 22-145" class="payInput">
        <h1 class="payTitle">Card Information</h1>
        <div class="cardIcons">
            <i class="bi bi-credit-card" style="font-size: 40px;"></i>
            <i class="bi bi-mastercard" style="font-size: 40px;"></i>
        </div>
        <input type="password" class="payInput" placeholder="Card Number">
        <div class="cardInfo">
            <input type="text" placeholder="mm" class="payInput sm">
            <input type="text" placeholder="yyyy" class="payInput sm">
            <input type="text" placeholder="cvv" class="payInput sm">
        </div>
        <button class="payButton">Checkout!</button>
        <span class="close">X</span>
    </div>
    <?php include('footer.php'); ?>
    <script src="./js/payment.js"></script>
</body>
</html>
