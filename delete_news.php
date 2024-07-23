<?php
session_start();
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    // if user role not equal to admin then it will redirect to home page
    if ($_SESSION['role'] != 'admin') {
        header("location: index.php");
    } else {

        // database connectioin
        include_once("configs/db_connection.php");

        $id = $_GET['id'];
        $sql = "DELETE from tbl_news where id=$id";
        $connection->query($sql);

        // redirect to categories list
        header("location:list_news.php");
    }
} else {
    header("location: login.php");
}
