<?php
include_once("includes/header.php");

if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location: login.php");
}

if (isset($_POST['bnt_profile_edit'])) {

    // echo "<pre>";
    // print_r($_FILES['image_file']);
    // echo "</pre>";

    if ($_FILES['image_file']['error'] == 0) {
        // check image type
        if (
            $_FILES['image_file']['type'] == "image/png" ||
            $_FILES['image_file']['type'] == "image/jpg" ||
            $_FILES['image_file']['type'] == "image/jpeg"
        ) {
            // check image size
            if ($_FILES['image_file']['size'] < 1000000) {
                // upload image 
                $image_new_name = uniqid() . '-' . $_FILES['image_file']['name'];

                $is_upload = move_uploaded_file($_FILES['image_file']['tmp_name'], "images/" . $image_new_name);

                if ($is_upload) {
                    include_once("configs/db_connection.php");
                    $user_email = $_SESSION['email'];
                    $sql = "UPDATE tbl_users set image='$image_new_name' where email='$user_email'";
                    $connection->query($sql);

                    $_SESSION['image'] = $image_new_name;
                }

                $image_uploaded_success = "Image Uploaed Succesful!";
            } else {
                $error_image = "Image size must be less than 1 MB";
            }
        } else {
            $error_image = "Invalid Image format";
        }
    } else {
        $error_image = "Image is required field!";
    }
}

?>
<main>
    <div class="container">
        <h1>Profile Edit</h1>
        <hr>

        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <?php
                if (isset($error_image)) {
                    echo "<p class='alert alert-danger'>$error_image</p>";
                }

                if (isset($image_uploaded_success)) {
                    echo "<p class='alert alert-success'>$image_uploaded_success</p>";
                }
                ?>

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