<?php
session_start();

// database connectioin
include_once("configs/db_connection.php");
$sql = "SELECT * from tbl_cagetogries";
$result = $connection->query($sql);

$categories = [];
while ($data = $result->fetch_assoc()) {
    array_push($categories, $data);
}

?>

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
                        <a href="." class="nav-link" href="#">Home</a>
                    </li>
                    <?php
                    if (isset($_SESSION['email']) && !empty($_SESSION['email'])) { ?>

                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li>
                                <a href="list_category.php" class="nav-link">
                                    Category Management
                                </a>
                            </li>
                            <li>
                                <a href="list_news.php" class="nav-link">
                                    News Management
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>
                        <li>
                            <a href="dashboard.php" class="nav-link">
                                <?php echo $_SESSION['name']; ?>
                            </a>
                        </li>
                        <li class="user-image">
                            <img src="images/<?php echo $_SESSION['image']; ?>" alt="">
                        </li>
                    <?php } else { ?>

                        <?php foreach ($categories as $cat) { ?>
                            <li>
                                <a href="?id=<?php echo $cat['id'] ?>" class="nav-link">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                        <li>
                            <a href="register.php" class="nav-link">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>