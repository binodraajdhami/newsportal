<?php
include_once("includes/header.php");
include_once("configs/db_connection.php");

$id = $_GET['id'];
$get_data_sql = "SELECT * from tbl_news where id=$id";
$result = $connection->query($get_data_sql);
$data = $result->fetch_assoc();
?>
<main>
    <div class="container">
        <h2><?php echo $data['title']; ?></h2> <span>
            <?php echo date_format(date_create($data['created_at']), "d M, Y"); ?>
        </span>

        <p><?php echo $data['short_description']; ?></p>

        <hr>

        <img src="images/<?php echo $data['thumbnail']; ?>" alt="" width="100%">

        <hr>
        <p><?php echo $data['description']; ?></p>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>