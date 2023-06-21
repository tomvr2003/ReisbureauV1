<?php
session_start();
include("./components/head.php");
include("./components/header.php");

if (isset($_POST["submit_button"])) {
    $rating = $_POST["rating"];
    $bericht = $_POST["bericht"];
    $user_id = $_SESSION["id"];
    $reis_id = $_GET["id"];


    $sql = "INSERT INTO recensie (rating, bericht, user_id, reis_id) VALUES (:rating, :bericht, :user_id, :reis_id)";
    $statement = $conn->prepare($sql);
    $statement->execute([
        ":rating" => $rating,
        ":bericht" => $bericht,
        "user_id" => $user_id,
        "reis_id" => $reis_id
    ]);

    header("Location: ./index.php");
    exit();
}

$reis_id = $_GET["id"];
$query = "SELECT * FROM reizen WHERE id=:id"; 
$stmt = $conn->prepare($query);
$stmt->execute([
    ":id" => $reis_id
]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="reispagina-container">
    <div class="reispagina-container-left">
        <img src="<?php echo $row["image"]; ?>" alt="reis" class="reispagina-image">
    </div>
    <div class="reispagina-container-right add-form-container-nop">
        <div class="add-form-container">
            <h1>Schrijf een review over <?php echo $row["title"]; ?></h1>
            <form method="POST" action="recensie.php?id=<?php echo $_GET["id"]; ?>">
                <input type="number" name="rating" class="review-form-input" min="1" max="10" placeholder="Rating">
                <textarea maxlength="300" name="bericht" class="review-form-input-ta" placeholder="Voeg een review toe..."></textarea>
                <input type="submit" name="submit_button" value="Submit" class="review-form-submit">
            </form>
        </div>
    </div>
</div>

<?php 
  include ("./components/footer.php");
?>
