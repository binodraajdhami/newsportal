<?php include_once("includes/header.php"); ?>
<?php

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location: login.php");
}

if (isset($_POST['bnt_profile_edit'])) {

    echo "<pre>";
    print_r($_FILES['image_file']);
    echo "</pre>";

    // check image type
    if (
        $_FILES['image_file']['type'] == "image/png" ||
        $_FILES['image_file']['type'] == "image/jpg" ||
        $_FILES['image_file']['type'] == "image/jpeg"
    ) {
        // check image size
        if ($_FILES['image_file']['size'] < 1024) {
            getcwd();
            // upload image 
            move_uploaded_file($_FILES['image_file']['tmp_name'], "");
        } else {
            $error_image = "Image size must be less than 1 MB";
        }
    } else {
        $error_image = "Invalid Image format";
    }
}

?>
<main>
    <div class="container">
        <h1>Profile Edit</h1>
        <hr>

        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="image">Update Image</label>
                <input type="file" name="image_file" class="form-control">
            </div>

            <button type="submit" name="bnt_profile_edit" class="btn btn-success">
                Update Profile
            </button>
        </form>

        <hr>

    </div>
</main>
<?php include_once("includes/footer.php"); ?>