<?php 
session_start();
include("./components/head.php");
include("./components/header.php");

if (isset($_POST["submit_button"])) {
    $bericht = $_POST["bericht"];
    $onderwerp = $_POST["onderwerp"];
    $user_id = $_SESSION["id"];

    $sql = "INSERT INTO contact (bericht, onderwerp, user_id) VALUES (:bericht, :onderwerp, :user_id)";
    $statement = $conn->prepare($sql);
    $statement->execute([
        ":bericht" => $bericht,
        ":onderwerp" => $onderwerp,
        ":user_id" => $user_id
    ]);

    header("Location: ./index.php");
    exit();
}

?>

<div class="container">
    <form action="contact.php" method="POST">
    <div class="form-group">
        <label for="message">Onderwerp:</label>
        <input id="onderwerp" name="onderwerp" required>
      </div>
      <div class="form-group">
        <label for="message">Bericht:</label>
        <textarea id="bericht" name="bericht" required></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name="submit_button">Verstuur</button>
      </div>
    </form>
  </div>

<?php
include("./components/footer.php");
?>