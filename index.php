<?php
include_once("includes/header.php");

// database connectioin
include_once("configs/db_connection.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $cat_id = $_GET['id'];
    // for individual news according to category_id
    $sql = "SELECT * from tbl_news where category_id=$cat_id";
} else {
    $sql = "SELECT * from tbl_news";
}
$result = $connection->query($sql);

$newses = [];
while ($data = $result->fetch_assoc()) {
    array_push($newses, $data);
}

?>

<main>
    <div class="container">
        <h1>Lates News</h1>

        <div class="row">

            <?php foreach ($newses as $news) { ?>
                <div class="col-sm-3">
                    <div class="news-card">
                        <div class="news-card-thumbnail">
                            <img src="images/<?php echo $news['thumbnail']; ?>" alt="" width="100%">
                        </div>
                        <div class="news-card-content">
                            <h4><?php echo $news['title']; ?></h4>
                            <a href="news_details.php?id=<?php echo $news['id']; ?>" class="btn btn-primary">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            <?php  } ?>

            <?php if (count($newses) == 0) {
                echo "<p class='alert alert-warning'>No datas...</p>";
            } ?>

        </div>
    </div>
</main>

<?php include_once("includes/footer.php"); ?>