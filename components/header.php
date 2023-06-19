<?php
require_once('connection.php');
?>

<header>
  <div class="header-left">
    <img src="./assets/plane.png" alt="logo" class="logo">
  </div>
  <div class="header-center">
    <nav>
      <ul class="nav-ul">
        <a href="./index.php"><li class="nav-li">Home</li></a>
        <a href=""><li class="nav-li">Over</li></a>
        <a href="./locaties.php"><li class="nav-li">Locaties</li></a>
        <a href="./contact.php"><li class="nav-li">Contact</li></a>
      </ul>
    </nav>
  </div>
  <div class="header-right">
    <?php
      if (!isset($_SESSION["username"])) {
        if(!isset($_SESSION['adminusername'])) {
          echo "<a href='./login.php'><button>Login</button></a>";
        }
        else if (isset($_SESSION['adminusername'])) {
          echo "<a href='./components/logout.php'><button>Logout</button></a>";
        }
      } 
      else if (isset($_SESSION['username'])) {
        echo "<a href='./account.php'><button>Account</button></a>";
        echo "<a href='./components/logout.php'><button>Logout</button></a>";
        if($_SESSION['isadmin'] == 1) { 
          echo "<a href='./adminpanel.php'><button>Admin panel</button></a>";
        }
      }
    ?>
  </div>
</header>
