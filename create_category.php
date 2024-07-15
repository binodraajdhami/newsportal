<?php
include_once("includes/header.php");

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    // if user role not equal to admin then it will redirect to home page
    if ($_SESSION['role'] != 'admin') {
        header("location: index.php");
    }
} else {
    header("location: login.php");
}


if (isset($_POST['bntcreate'])) {

    // check image error
    if ($_FILES['image']['error'] == 0) {
        // check image type
        if (
            $_FILES['image']['type'] == "image/png" ||
            $_FILES['image']['type'] == "image/jpg" ||
            $_FILES['image']['type'] == "image/jpeg"
        ) {
            // check image size
            if ($_FILES['image']['size'] < 1000000) {
                $image_new_name = uniqid() . '-' . $_FILES['image']['name'];
                $isUploaded = move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image_new_name);
                if ($isUploaded) {
                    $image = $image_new_name;
                }
            }
        }
    }

    $created_by = $_SESSION['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $rank = $_POST['rank'];
    $status = $_POST['status'];
    $image_file = isset($image) ? $image : '';

    if (isset($created_by) && isset($name) && isset($description) && isset($rank) && isset($status)) {
        include_once("configs/db_connection.php");

        $sql = "INSERT into tbl_cagetogries 
                (name,description,rank,status,image,created_by)
                values('$name','$description',$rank,$status,'$image_file',$created_by)";

        $connection->query($sql);
    }
}
?>
<main>
    <div class="container">
        <h2>Add Category</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="rank">Rank</label>
                <input type="number" min="1" id="rank" name="rank" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" name="status" value="1">Active
                <input type="radio" name="status" value="0" checked> Deactive
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <br>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" name="bntcreate" class="btn btn-primary">Create Category</button>
        </form>
    </div>
</main>

<style>
    .form-group {
        margin-bottom: 15px;
    }
</style>

<?php include_once("includes/footer.php"); ?>