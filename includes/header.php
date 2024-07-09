<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="." class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <?php
                    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) { ?>
                        <li>
                            <a href="logout.php" class="nav-link" aria-current="page">Logout</a>
                        </li>
                        <li>
                            <a href="dashboard.php" class="nav-link" aria-current="page">
                                <?php echo $_SESSION['name']; ?>
                            </a>
                        </li>
                        <li class="user-image">
                            <img src="images/<?php echo $_SESSION['image']; ?>" alt="">
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="login.php" class="nav-link" aria-current="page">Login</a>
                        </li>
                        <li>
                            <a href="register.php" class="nav-link" aria-current="page">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>