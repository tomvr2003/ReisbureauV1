<?php
session_start();
include("./components/head.php");
include("./components/header.php");

if (isset($_POST["submit_button"])) {
    $title = $_POST["title"];
    $omschrijving = $_POST["omschrijving"];
    $reisinfo = $_POST["reisinfo"];
    $star = $_POST["star"];
    $rating = $_POST["rating"];
    $prijs = $_POST["prijs"];
    $image = $_POST["image"];

    $sql = "INSERT INTO reizen (title, omschrijving, reisinfo, star, rating, prijs, image) VALUES (:title, :omschrijving, :reisinfo, :star, :rating, :prijs, :image)";
    $statement = $conn->prepare($sql);
    $statement->execute([
        ":title" => $title,
        ":omschrijving" => $omschrijving,
        ":reisinfo" => $reisinfo,
        ":star" => $star,
        ":rating" => $rating,
        ":prijs" => $prijs,
        ":image" => $image
    ]);

    header("Location: ./adminpanel.php");
    exit();
}
?>

<div class="add-form-container">
  <h1>Reis toevoegen</h1>
    <form action="add-reis.php" method="POST">
      <input type="text" name="title" placeholder="Voeg een titel toe...">
      <input type="text" name="omschrijving" placeholder="Voeg een omschrijving toe...">
      <input type="text" name="reisinfo" placeholder="Voeg reisinfo toe...">
      <input type="text" name="star" placeholder="Voeg een star toe...">
      <input type="text" name="rating" placeholder="Voeg een rating toe...">
      <input type="text" name="prijs" placeholder="Voeg een prijs toe...">
      <input type="text" name="image" placeholder="Voeg een image toe...">
      <button style="background-color: #7189FF; margin-top: 20px;" type="submit" name="submit_button">Submit</button>
    </form>
</div>

<?php 
  include ("./components/footer.php");
?>
