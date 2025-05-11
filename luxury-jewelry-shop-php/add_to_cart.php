<?php
    session_start();
    include("config.php");

    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $query = "UPDATE cart SET quantity = quantity + 1, updated_at = ? WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $updated_at, $user_id, $product_id);
        $stmt->execute();
    } else {
        $query = "INSERT INTO cart (user_id, product_id, quantity, created_at, updated_at) VALUES (?, ?, 1, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiss", $user_id, $product_id, $created_at, $updated_at);
        $stmt->execute();
    }

    header("Location: cart.php");
    exit();
?>
