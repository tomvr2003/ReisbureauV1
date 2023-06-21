<?php session_start(); 

include("./components/head.php");

include("./components/header.php");

$id = $_GET['id'];
$sql = 'SELECT * FROM reizen WHERE id=:id';
$statement = $conn->prepare($sql);
$statement->execute(['id' => $id ]);
$reis = $statement->fetch(PDO::FETCH_OBJ);

if(isset($_POST['submit_button'])) {
  $title = $_POST["title"];
  $omschrijving = $_POST["omschrijving"];
  $reisinfo = $_POST["reisinfo"];
  $star = $_POST["star"];
  $rating = $_POST["rating"];
  $prijs = $_POST["prijs"];
  $image = $_POST["image"];

  $sql = "UPDATE reizen SET title=:title, omschrijving=:omschrijving, reisinfo=:reisinfo, star=:star, rating=:rating, prijs=:prijs, image=:image WHERE id=:id";
  $statement = $conn->prepare($sql);
  $statement->execute([":title" => $title, ":omschrijving" => $omschrijving, ":reisinfo" => $reisinfo, ":star" => $star, ":rating" => $rating, ":prijs" => $prijs, ":image" => $image, ":id" => $id ]);
  
  header("Location:adminpanel.php");
  exit();
}

if(isset($_SESSION["isadmin"])) {

?>

<main class="add-form-container">
  <form method="POST" action="" class="add-form">
    <input type="hidden" name="id" value="<?= $reis->id ?>">
    <input value="<?= $reis->title ?>" type="text" id="title" name="title">
    <input value="<?= $reis->omschrijving ?>" type="text" id="omschrijving" name="omschrijving">
    <input value="<?= $reis->reisinfo ?>" type="text" id="reisinfo" name="reisinfo">
    <input value="<?= $reis->star ?>" type="text" id="star" name="star">
    <input value="<?= $reis->prijs ?>" type="text" id="prijs" name="prijs">
    <input value="<?= $reis->rating ?>" type="text" id="rating" name="rating">
    <input value="<?= $reis->image ?>" type="text" id="image" name="image">
    <button type="submit" style="background-color: #7189FF; margin-top: 20px;" name="submit_button">Submit</button>
  </form>
</main>

<?php 
  }
  else {
    echo "<center><h1 style='margin-top: 50px;'>Je hebt geen permissie om dit gericht te bewerken</h1></center>";
    echo "<center><a href='./login.php'><button style='margin-top: 30px; color: black;' class='index-button'>Log in</button></a></center>";
  }
?>