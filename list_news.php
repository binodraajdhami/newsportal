<?php
include_once("includes/header.php");

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    // if user role not equal to admin then it will redirect to home page
    if ($_SESSION['role'] != 'admin') {
        header("location: index.php");
    } else {

        // database connectioin
        include_once("configs/db_connection.php");
        $sql = "SELECT * from tbl_news";
        $result = $connection->query($sql);

        $newses = [];
        while ($data = $result->fetch_assoc()) {

            $user_id =  $data['created_by'];
            $get_user = "SELECT * from tbl_users where id=$user_id";
            $user = $connection->query($get_user);
            $data['created_by'] =  $user->fetch_assoc();

            array_push($newses, $data);
        }
    }
} else {
    header("location: login.php");
}
?>
<main>
    <div class="container">
        <a href="create_news.php" class="btn btn-primary">Add News</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Category ID </th>
                    <th>Created By</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newses as $index => $news) { ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $news['category_id']; ?></td>
                        <td><?php echo $news['created_by']['name']; ?></td>
                        <td><?php echo $news['title']; ?></td>
                        <td><?php echo $news['short_description']; ?></td>
                        <td>
                            <a href="view_news.php?id=<?php echo $news['id']; ?>" class="btn btn-primary">View</a>
                            <a href="edit_news.php?id=<?php echo $news['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="delete_news.php?id=<?php echo $news['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>