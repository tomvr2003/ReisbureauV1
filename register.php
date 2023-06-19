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

            <script>
            </script>

            <form action="register.php" method="POST" class="login-form" onsubmit="return checkForm()">
                <h1 style="margin-bottom: 10px;" class="login-form-title">Registreer</h1>
                <input type="text" name="username" placeholder="Gebruikersnaam" minlength="3" required>
                <input type="text" name="email" placeholder="Email" required>
                <input style="margin-bottom: 20px;" required type="password" name="password" placeholder="Wachtwoord">
                <button style="background-color: #7189FF; margin-bottom: 20px;" type="submit" name="register">Registreer</button>
            </form>
            <p>Al een account? <a href="./login.php"><span class="register-text">Login</span></a></p>
        </div>
    </section>
</main>

<?php
include("./components/footer.php");
?>
