<?php
include_once("includes/header.php");
include_once("configs/db_connection.php");

$id = $_GET['id'];
$get_data_sql = "SELECT * from tbl_cagetogries where id=$id";
$result = $connection->query($get_data_sql);
$data = $result->fetch_assoc();

// fetch user details
$created_by_id = $data['created_by'];
$created_by_sql = "SELECT * from tbl_users where id=$created_by_id";
$created_by_result = $connection->query($created_by_sql);
$created_by_details = $created_by_result->fetch_array();

if ($data['updated_by'] != 0) {
    $updated_by_id = $data['updated_by'];
    $updated_by_sql = "SELECT * from tbl_users where id=$updated_by_id";
    $updated_by_result = $connection->query($updated_by_sql);
    $updated_by_details = $updated_by_result->fetch_array();
}

?>
<main>
    <div class="container">
        <h2>Details Category</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo $data['id']; ?></td>
            </tr>
            <tr>
                <th>Created By</th>
                <td><?php echo $created_by_details['name']; ?></td>
            </tr>
            <tr>
                <th>Updated By</th>
                <td><?php if (isset($updated_by_details['name'])) {
                        echo $updated_by_details['name'];
                    } ?></td>
            </tr>
            <tr>
                <th>Rank</th>
                <td><?php echo $data['rank']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php if ($data['status'] == 1) {
                        echo "Active";
                    } else {
                        echo "Deactive";
                    } ?></td>
            </tr>
        </table>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>