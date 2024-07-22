<?php
include_once("includes/header.php");

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    // if user role not equal to admin then it will redirect to home page
    if ($_SESSION['role'] != 'admin') {
        header("location: index.php");
    } else {

        // database connectioin
        include_once("configs/db_connection.php");
        $sql = "SELECT * from tbl_cagetogries";
        $result = $connection->query($sql);

        $categories = [];
        while ($data = $result->fetch_assoc()) {

            $user_id =  $data['created_by'];
            $get_user = "SELECT * from tbl_users where id=$user_id";
            $user = $connection->query($get_user);
            $data['created_by'] =  $user->fetch_assoc();

            array_push($categories, $data);
        }
    }
} else {
    header("location: login.php");
}
?>
<main>
    <div class="container">
        <a href="create_category.php" class="btn btn-primary">Add Category</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Category Name</th>
                    <th>Created By</th>
                    <th>Rank</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $index => $category) { ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <td><?php echo $category['created_by']['name']; ?></td>
                        <td><?php echo $category['rank']; ?></td>
                        <td>
                            <a href="view_category.php?id=<?php echo $category['id']; ?>" class="btn btn-primary">View</a>
                            <a href="edit_category.php?id=<?php echo $category['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="delete_category.php?id=<?php echo $category['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>