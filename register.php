<?php session_start();
include("./components/head.php");
include("./components/header.php");
?>

<main>
    <section class="section-login">
        <div class="section-login-left">
            <img src="./assets/banner-login.png" alt="banner-login" class="login-banner">
        </div>
        <div class="section-login-right">
          <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              require("./components/connection.php");
          
              $username = $_POST['username'];
              $email = $_POST['email'];
              $password = $_POST['password'];
          
              $sql = "INSERT INTO login(username, email, password) VALUES(:username, :email, :password)";
              $statement = $conn->prepare($sql);
              $statement->bindParam(":username", $username);
              $statement->bindParam(":email", $email);
              $statement->bindParam(":password", $password);
          
              if ($statement->execute()) {
                  echo "<p style='margin-bottom: 20px; font-weight: 500;'>Succesvol geregistreerd</p>";
              }
            }
          ?>

            <form action="register.php" method="POST" class="login-form" onsubmit="return validateRegistrationForm()">
                <h1 style="margin-bottom: 10px;" class="login-form-title">Registreer</h1>
                <input type="text" name="username" placeholder="Gebruikersnaam">
                <input type="text" name="email" placeholder="Email">
                <input style="margin-bottom: 20px;" type="password" name="password" placeholder="Wachtwoord">
                <button style="background-color: #7189FF; margin-bottom: 20px;" type="submit" name="register">Registreer</button>
            </form>
            <script>
              function validateRegistrationForm() {
                  var usernameInput = document.getElementsByName("username")[0];
                  var emailInput = document.getElementsByName("email")[0];
                  var passwordInput = document.getElementsByName("password")[0];
                  var restrictedCharacters = /[!@#$%^&*]/;

                  if (usernameInput.value.trim() === "") {
                      alert("Voer een geldige gebruikersnaam in.");
                      usernameInput.focus();
                      return false;
                  }

                  if (restrictedCharacters.test(usernameInput.value.trim())) {
                      alert("Gebruikersnaam kan de volgende karakters niet bevatten: !@#$%^&*");
                      usernameInput.focus();
                      return false;
                  }

                  if (emailInput.value.trim() === "") {
                      alert("Voer een geldig e-mailadres in.");
                      emailInput.focus();
                      return false;
                  }

                  var emailRegex = /^\S+@\S+\.\S+$/;
                  if (!emailRegex.test(emailInput.value.trim())) {
                      alert("Voer een geldig e-mailadres in.");
                      emailInput.focus();
                      return false;
                  }

                  if (passwordInput.value.trim() === "") {
                      alert("Voer een wachtwoord in.");
                      passwordInput.focus();
                      return false;
                  }

                  return true;
              }
          </script>
            <p>Al een account? <a href="./login.php"><span class="register-text">Login</span></a></p>
        </div>
    </section>
</main>

<?php
include("./components/footer.php");
?>
