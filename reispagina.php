<?php
session_start();
include("./components/head.php");
include("./components/header.php");

$id = $_GET["id"]; 

$query = "SELECT *, reizen.id as reisid FROM reizen WHERE id = :id"; 
$stmt = $conn->prepare($query);
$stmt->bindParam(":id", $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit_button'])) {
    $user_id = $_SESSION["id"];
    $reis_id = $_GET["id"];
    $datum = $_POST["datum"];
  
    $sql = "INSERT INTO boekingen (user_id, reis_id, datum) VALUES (:user_id, :reis_id, :datum)";
    $statement = $conn->prepare($sql);
    $statement->execute([
        ":user_id" => $user_id,
        ":reis_id" => $reis_id,
        ":datum" => $datum
    ]);
    
    header("Location:./index.php");
    exit();
  }

?>



<div class="reispagina-container">
    <div class="reispagina-container-left">
        <img src="<?php echo $row["image"]; ?>" alt="reis" class="reispagina-image">
    </div>
    <div class="reispagina-container-right">
        <div class="reispagina-container-right-1">
            <i class="fa-solid fa-star fa-s-2"></i>
            <h3 class="star-text-reispagina"><?php echo $row["star"]; ?></h3>
            <i class="fa-solid fa-message fa-m-2"></i>
            <h3 class="rating-6-reispagina"><?php echo $row["rating"]; ?></h3>
        </div>
        <div class="reispagina-container-right-2">
            <h1 class="top-6-title" style="font-size: 40px;"><?php echo $row["title"]; ?></h1>
        </div>
        <div class="reispagina-container-right-3">
            <h4 class="top-6-des"><?php echo $row["omschrijving"]; ?></h4>
        </div>
        <div class="reispagina-container-right-4">
            <h6 style="font-weight: 500;" class="top-6-des"><?php echo $row["reisinfo"]; ?></h6>
        </div>
        <form action="reispagina.php?id=<?php echo $_GET['id'];?>" method="POST">
            <div class="reispagina-container-right-5">
                <input type="date" min="2023-06-23" max="2024-06-23" name="datum" required>
            </div>
            <div class="reispagina-container-right-6">
                <button type="submit" name="submit_button" class="reispagina-button">Boeken</button>
            </div>
        </form>
        <div class="reispagina-container-right-7">
            <h4 style="font-size: 40px;" class="top-6-title"><?php echo "€ " . $row["prijs"]; ?>,-</h4>
        </div>
    </div>
</div>

<div class="recensies-container">
    <div class="recensies-top">
        <a href="./recensie.php?id=<?php echo $row["reisid"]; ?>"><button class="recensie-button">Schrijf een recensie!</button></a>
    </div>
    <?php 
    $reis_id = $_GET["id"];
    $sql = "SELECT * FROM recensie r INNER JOIN login l on r.user_id = l.id WHERE r.reis_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":id" => $reis_id
    ]);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="recensies-bottom">
        <div class="recensies-bottom-con">
            <div class="recensie-bottom-con-top">
                <h1><?php echo $row["username"] ?></h1>
                <h1 style="color: #7189FF;"><?php echo $row["rating"] ?> </h1>
            </div>
            <p class="recensie-text"><?php echo $row["bericht"] ?></p>
            <div class="blue-line"></div>
        </div>
    </div>
    <?php } ?>
</div>

<?php
include("./components/footer.php");
?>
