<?php
session_start();
include("./components/head.php");
include("./components/header.php");
?>

<?php
  if (!isset($_SESSION["username"])) { 
    echo "<center><h1 style='margin-top: 20px;'>Je moet ingelogd zijn om deze pagina te bezoeken</h1><center>";
  } 
  else {
?>

<main style="display: flex; justify-content: center;">
  <div class="account-container">
    <div class="account-info">
      <h1 class="acc-username"><?= $_SESSION['username'] ?></h1>
      <p class="acc-email"><?= $_SESSION['email'] ?></p>
    </div>
    <div class="account-boekingen">
      <div class="account-boekingen-top">
        <h4>Mijn boekingen:</h4>
      </div>
      <div class="account-boekingen-bottom">
    <?php
      $user_id = $_SESSION["id"];
      $query = "SELECT * FROM boekingen INNER JOIN reizen on reis_id = reizen.id WHERE user_id = :user_id";
      $stmt = $conn->prepare($query);
      $stmt->execute([
        ":user_id" => $user_id
      ]);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div id="top-6">
            <div class="top-6-boxes-container" style="margin-bottom: 50px;">
                <div class="top-6-box">
                    <div class="top-6-box-left">
                        <img src="<?php echo $row["image"]; ?>" alt="place" class="top-6-img">
                    </div>
                    <div class="top-6-box-center">
                        <h3 class="top-6-title"><?php echo $row["title"]; ?></h3>
                        <h4 class="top-6-des"><?php echo $row["omschrijving"]; ?></h4>
                        <div class="reis-info-6">
                            <h6 style="font-weight: 500;" class="top-6-des"><?php echo $row["reisinfo"]; ?></h6>
                        </div>
                    <div class="top-6-box-right">
                      <a href="annuleer.php?id=<?php echo $row['id']; ?>"><button style="background-color: #7189FF;">Annuleer</button></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  <?php 
    }
  ?>
  </div>
</main>

<?php
  }
  include("./components/footer.php");
?>