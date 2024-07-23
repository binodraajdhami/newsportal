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

include_once("configs/db_connection.php");
// fetch current news details
$id = $_GET['id'];
$get_data_sql = "SELECT * from tbl_news where id=$id";
$result = $connection->query($get_data_sql);
$news_data = $result->fetch_assoc();

// fetch categories
$category_sql = "SELECT * from tbl_cagetogries";
$cat_result = $connection->query($category_sql);
$categories = [];
while ($data = $cat_result->fetch_assoc()) {
    array_push($categories, $data);
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

    $updated_by = $_SESSION['id'];
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $short_description = $_POST['short_description'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $thumbnail = isset($image) ? $image : $news_data['thumbnail'];

    if (
        isset($updated_by) &&
        isset($category_id) &&
        isset($title) &&
        isset($short_description) &&
        isset($description) &&
        isset($thumbnail) &&
        isset($status)
    ) {

        $sql = "UPDATE tbl_news set
                 title='$title',
                 category_id=$category_id,
                 short_description='$short_description',
                 description='$description',
                 status=$status,
                 thumbnail='$thumbnail',
                updated_by=$updated_by
                where id=$id";

        $connection->query($sql);

        header("location:list_news.php");
    }
}
?>
<main>
    <div class="container">
        <h2>Add News</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input value="<?php echo $news_data['title']; ?>" type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>

                    <?php foreach ($categories as $category) { ?>

                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $news_data['category_id'] ? 'selected' : ''; ?>>
                            <?php echo $category['name']; ?>
                        </option>

                    <?php } ?>

                </select>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea id="short_description" name="short_description" class="form-control"><?php echo $news_data['short_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" rows="5" name="description" class="form-control"><?php echo $news_data['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <br>
                <input type="radio" name="status" value="1" <?php echo $news_data['status'] == 1 ? "checked" : ""; ?>>Active
                <input type="radio" name="status" value="0" <?php echo $news_data['status'] == 0 ? "checked" : ""; ?>> Deactive
            </div>
            <div class="form-group">
                <label for="image">Thumbnail</label>
                <br>
                <img src="images/<?php echo $news_data['thumbnail'] ?>" alt="" width="200">
                <br>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" name="bntcreate" class="btn btn-primary">Update News</button>
        </form>
    </div>
</main>

<style>
    .form-group {
        margin-bottom: 15px;
    }
</style>

<?php include_once("includes/footer.php"); ?>