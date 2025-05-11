<?php
    session_start();
    include("config.php");

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please log in to view your cart.'); window.location.href='login.php';</script>";
    }

    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $cart_id = $_POST['cart_id'];
        
        if ($_POST['action'] === 'increase') {
            $query = "UPDATE cart SET quantity = quantity + 1 WHERE cart_id = ? AND user_id = ?";
        } elseif ($_POST['action'] === 'decrease') {
            $query = "UPDATE cart SET quantity = quantity - 1 WHERE cart_id = ? AND user_id = ? AND quantity > 1";
        } elseif ($_POST['action'] === 'remove') {
            $query = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
        }

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
        
        $query = "SELECT SUM(cart.quantity * products.product_price) AS total_price, SUM(cart.quantity) AS total_items
                FROM cart JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $summary = $stmt->get_result()->fetch_assoc();

        echo json_encode([
            "success" => true,
            "total_items" => $summary["total_items"] ?? 0,
            "total_price" => $summary["total_price"] ?? 0
        ]);
        exit();
    }

    $query = "
        SELECT cart.cart_id, cart.product_id, products.product_name, products.product_price, products.product_image_url, cart.quantity
        FROM cart JOIN products ON cart.product_id = products.product_id
        WHERE cart.user_id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $total_price = 0;
    $total_items = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/StylesCart.css">
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <nav id="nav">
        <?php include('navbar.php'); ?>
    </nav>
    <br><br>

    <div class="cart-container">
        <h1>Your Shopping Cart</h1>

        <div class="cart-items">
            <?php
            while ($row = $result->fetch_assoc()) {
                $item_total = $row['product_price'] * $row['quantity'];
                $total_price += $item_total;
                $total_items += $row['quantity'];

                echo '
                <div class="cart-item" data-cart-id="' . $row['cart_id'] . '">
                    <img src="' . $row['product_image_url'] . '" alt="Product Image" class="product-image">
                    <div class="cart-details">
                        <h2>' . $row['product_name'] . '</h2>
                        <p>Price: $' . $row['product_price'] . '</p>
                        <div class="quantity-control">
                            <button class="qty-btn decrease" data-cart-id="' . $row['cart_id'] . '">-</button>
                            <span class="quantity">' . $row['quantity'] . '</span>
                            <button class="qty-btn increase" data-cart-id="' . $row['cart_id'] . '">+</button>
                        </div>
                        <p class="item-total">Total: $' . $item_total . '</p>
                        <button class="remove-btn" data-cart-id="' . $row['cart_id'] . '">Remove</button>
                    </div>
                </div>';
            }
            ?>

            <div class="cart-summary">
                <h2>Total Items: <span id="total-items"><?= $total_items ?></span></h2>
                <h2>Total Price: $<span id="total-price"><?= $total_price ?></span></h2>
                <button type="button" class="buy-all-btn buy-now" onclick="openPayment()" >Buy All</button>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <script>
        $(document).ready(function () {
            $(".increase").click(function () {
                let cartId = $(this).data("cart-id");
                updateQuantity(cartId, "increase");
            });

            $(".decrease").click(function () {
                let cartId = $(this).data("cart-id");
                updateQuantity(cartId, "decrease");
            });

            $(".remove-btn").click(function () {
                let cartId = $(this).data("cart-id");
                $.post("cart.php", { cart_id: cartId, action: "remove" }, function (response) {
                    let data = JSON.parse(response);
                    if (data.success) {
                        $(".cart-item[data-cart-id='" + cartId + "']").fadeOut(500, function () {
                            $(this).remove();
                            updateCartSummary(data);
                        });
                    }
                });
            });

            function updateQuantity(cartId, action) {
                $.post("cart.php", { cart_id: cartId, action: action }, function (response) {
                    let data = JSON.parse(response);
                    if (data.success) {
                        let item = $(".cart-item[data-cart-id='" + cartId + "']");
                        let quantityElem = item.find(".quantity");
                        let newQuantity = action === "increase" ? parseInt(quantityElem.text()) + 1 : parseInt(quantityElem.text()) - 1;
                        quantityElem.text(newQuantity);
                        item.find(".item-total").text("Total: $" + (newQuantity * parseFloat(item.find("p:nth-child(2)").text().split("$")[1])));
                        updateCartSummary(data);
                    }
                });
            }

            function updateCartSummary(data) {
                $("#total-items").text(data.total_items);
                $("#total-price").text(data.total_price);
            }
        });
    </script>
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
    <script src="./js/payment.js"></script>
</body>
</html>
