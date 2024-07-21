<?php
include_once("includes/header.php");
include_once("configs/db_connection.php");

$id = $_GET['id'];
$get_data_sql = "SELECT * from tbl_cagetogries where id=$id";
$result = $connection->query($get_data_sql);
$data = $result->fetch_assoc();

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    // if user role not equal to admin then it will redirect to home page
    if ($_SESSION['role'] != 'admin') {
        header("location: index.php");
    }
} else {
    header("location: login.php");
}


if (isset($_POST['bntupdate'])) {

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

    $updated_by = $_SESSION['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $rank = $_POST['rank'];
    $status = $_POST['status'];
    $image_file = isset($image) ? $image : '';

    if (isset($updated_by) && isset($name) && isset($description) && isset($rank) && isset($status)) {
        include_once("configs/db_connection.php");

        $sql = "UPDATE tbl_cagetogries set name='$name',
                description='$description',
                rank=$rank,
                status=$status,
                image='$image_file',
                updated_by='$updated_by' where id=$id";

        $connection->query($sql);

        header("location:list_category.php");
    } else {
        $error_somethis = "Something went wrong!";
    }
}
?>
<main>
    <div class="container">
        <h2>Update Category</h2>
        <?php if (isset($error_somethis)) {
            echo $error_somethis;
        } ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $data['name']; ?>">
            </div>
            <div class="form-group">
                <label for="rank">Rank</label>
                <input type="number" min="1" id="rank" name="rank" class="form-control" value="<?php echo $data['rank']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"><?php echo $data['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" name="status" value="1" <?php echo $data['status'] == 1 ? "checked" : ""; ?>>Active
                <input type="radio" name="status" value="0" <?php echo $data['status'] == 0 ? "checked" : ""; ?>> Deactive
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <br>
                <img src="images/<?php echo $data['image'] ?>" alt="" width="200">
                <br>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" name="bntupdate" class="btn btn-primary">Update Category</button>
        </form>
    </div>
</main>

<style>
    .form-group {
        margin-bottom: 15px;
    }
</style>

<?php include_once("includes/footer.php"); ?>