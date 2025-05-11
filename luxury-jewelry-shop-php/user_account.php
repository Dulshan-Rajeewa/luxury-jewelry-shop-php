<?php
    session_start();
    include("config.php");

    if (!isset($_SESSION['user_id'])) {
        die("Please log in to access your account.");
    }

    $user_id = $_SESSION['user_id'];

    $query = "SELECT first_name, last_name, email, phone_number, address FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    $query = "
        SELECT products.product_name, products.product_price, cart.quantity, cart.created_at
        FROM cart
        JOIN products ON cart.product_id = products.product_id
        WHERE cart.user_id = ?
        ORDER BY cart.created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone_number'];
        $address = $_POST['address'];

        $query = "UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, address = ?, updated_at = NOW() WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $address, $user_id);
        
        if ($stmt->execute()) {
            $message = "Profile updated successfully!";
        } else {
            $message = "Error updating profile.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $query = "SELECT password_hash FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (password_verify($current_password, $result['password_hash'])) {
            $query = "UPDATE users SET password_hash = ?, updated_at = NOW() WHERE user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_password, $user_id);

            if ($stmt->execute()) {
                $message = "Password updated successfully!";
            } else {
                $message = "Error updating password.";
            }
        } else {
            $message = "Incorrect current password.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            session_destroy();
            header("Location: index.php");
            exit();
        } else {
            $message = "Error deleting account.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="css/StylesAccount.css">
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <nav id="nav">
        <?php include('navbar.php'); ?>
    </nav>
    <br><br>

    <div class="account-container">
        <h1>My Account</h1>
        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

        <form method="POST">
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

            <label>Email:</label>
            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>

            <label>Phone Number:</label>
            <input type="text" name="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>" required>

            <label>Address:</label>
            <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>

            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <h2>Change Password</h2>
        <form method="POST">
            <label>Current Password:</label>
            <input type="password" name="current_password" required>

            <label>New Password:</label>
            <input type="password" name="new_password" required>

            <button type="submit" name="update_password">Update Password</button>
        </form>

        <h2>Order History</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Ordered At</th>
            </tr>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($order['product_name']) ?></td>
                    <td>$<?= $order['product_price'] ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <form method="POST">
            <button type="submit" name="delete_account" class="delete-btn">Delete Account</button>
        </form>
    </div>

</body>
</html>
