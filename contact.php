<?php 
session_start();
include("./components/head.php");
include("./components/header.php");

  if (!isset($_SESSION["username"])) { 
    echo "<center><h1 style='margin-top: 50px;'>Je moet ingelogd zijn om een bericht te sturen</h1><center>";
    echo "<center><h3 style='margin-top: 20px; margin-bottom: 70vh;'><a style='text-decoration: underline; color: #3366CC;' href='./login.php'>Login</a></h3><center>";
  } 
  else {

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

<div class="container" style="margin-bottom: 320px;">
  <form action="contact.php" method="POST" onsubmit="return validateContactForm()">
      <div class="form-group">
          <label for="onderwerp">Onderwerp:</label>
          <input id="onderwerp" name="onderwerp">
      </div>
      <div class="form-group">
          <label for="bericht">Bericht:</label>
          <textarea id="bericht" name="bericht"></textarea>
      </div>
      <div class="form-group">
          <button type="submit" name="submit_button">Verstuur</button>
      </div>
  </form>
  </div>

  <script>
    function validateContactForm() {
        var onderwerpInput = document.getElementById("onderwerp");
        var berichtInput = document.getElementById("bericht");

        if (onderwerpInput.value.trim() === "") {
            alert("Voer een onderwerp in.");
            onderwerpInput.focus();
            return false;
        }

        if (berichtInput.value.trim() === "") {
            alert("Voer een bericht in.");
            berichtInput.focus();
            return false;
        }

        if (berichtInput.value.length < 50) {
            alert("Het bericht moet minimaal 50 tekens bevatten.");
            berichtInput.focus();
            return false;
        }

        return true;
    }
  </script>

<?php
  }
include("./components/footer.php");
?>