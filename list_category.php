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
?>
<main>
    <div class="container">
        <a href="create_category.php" class="btn btn-primary">Add Category</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Category Name</th>
                    <th>Rank</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Edcation</td>
                    <td>1</td>
                    <td><button class="btn btn-success">Edit</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>