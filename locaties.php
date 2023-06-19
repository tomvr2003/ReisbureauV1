<?php
session_start();
include("./components/head.php");
include("./components/header.php");
?>

<div class="index-banner">
  <h1 class="banner-title">Locaties</h1>
</div>

<?php
    $sql = 'SELECT * FROM reizen';
    $statement = $conn->prepare($sql);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
?>
    <div id="top-6" style="margin-top: 50px;">
        <div class="top-6-boxes-container">
            <a href="reispagina.php?id=<?php echo $row['id'];?>"><div class="top-6-box">
                <div class="top-6-box-left">
                    <img src="<?php echo $row["image"]; ?>" alt="place" class="top-6-img">
                </div>
                <div class="top-6-box-center">
                    <div class="star-rating-6">
                        <i class="fa-solid fa-star"></i>
                        <h3 class="star-text"><?php echo $row["star"]; ?></h3>
                    </div>
                    <h3 class="top-6-title"><?php echo $row["title"]; ?></h3>
                    <h4 class="top-6-des"><?php echo $row["omschrijving"]; ?></h4>
                    <div class="reis-info-6">
                        <h6 style="font-weight: 500;" class="top-6-des"><?php echo $row["reisinfo"]; ?></h6>
                    </div>
                </div>
                <div class="top-6-box-right">
                    <i class="fa-solid fa-message"></i>
                    <h3 class="rating-6"><?php echo $row["rating"]; ?></h3>
                </div>
            </div></a>
        </div>
    </div>
    <?php
}
?>

<div style="margin-bottom: 100px;"></div>

<?php
include("./components/footer.php");
?>
