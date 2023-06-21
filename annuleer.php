<?php 
    require("./components/connection.php");
    $id = $_GET['id'];
    if(isset($_GET['confirm'])) {
        $sql = 'DELETE FROM boekingen WHERE id=:id';
        $statement = $conn->prepare($sql);
        if($statement->execute([':id' => $id ])) {
            header("location:./account.php");
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'if(confirm("Weet je zeker dat je deze reis wilt annuleren?")){';
        echo 'window.location.href="annuleer.php?id=' . $id . '&confirm=yes";';
        echo '} else {';
          echo 'window.location.href="./account.php"';
        echo '}';
        echo '</script>';
    }
?>
