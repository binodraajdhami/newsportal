<?php include_once("includes/header.php"); ?>
<?php

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location: login.php");
}

?>
<main>
    <div class="container">
        <h1>Welcome dashaboard</h1>

        <a href="profile_edit.php">Edit Profile</a>
    </div>
</main>
<?php include_once("includes/footer.php"); ?>