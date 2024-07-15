<?php
include_once("includes/header.php");

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location: login.php");
}
?>

<main>

</main>

<?php include_once("includes/footer.php"); ?>