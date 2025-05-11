<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        $firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Users';
    } else {
        $firstName = 'Guest';
    }
?>

<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">
            <a href="index.php">Luxurious Legacy</a>
        </div>
        <ul class="navbar-links">
            <li class="navbar-item"><a href="index.php">Home</a></li>
            <li class="navbar-item"><a href="products.php">Products</a></li>
            <li class="navbar-item"><a href="cart.php">Cart</a></li>
            <li class="navbar-item"><a href="about_us.php">About Us</a></li>

            <li class="navbar-item">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="user_account.php">Hello, <?php echo htmlspecialchars($firstName); ?></a>
                    <a href="logout.php" class="logout-btn">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
            <li></li>
            <li></li>
        </ul>
    </div>
</nav>



<style>
    .navbar {
        background-color: rgb(0, 0, 0);
        padding: 10px 20px;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar-brand a {
        color: gold;
        text-decoration: none;
        font-size: 24px;
        font-weight: bold;
    }

    .navbar-links {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .navbar-item a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        padding: 10px;
    }

    .navbar-item a:hover {
        background-color: gold;
        border-radius: 5px;
    }

    .logout-btn {
        color: red;
        font-weight: bold;
        margin-left: 10px;
    }

    .logout-btn:hover {
        color: white;
        background-color: red;
        border-radius: 5px;
    }
</style>
