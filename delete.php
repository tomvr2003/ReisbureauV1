<?php 
    require("./components/connection.php");
    $id = $_GET['id'];
    if(isset($_GET['confirm'])) {
        $sql = 'DELETE FROM reizen WHERE id=:id';
        $statement = $conn->prepare($sql);
        if($statement->execute([':id' => $id ])) {
            header("location:adminpanel.php");
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'if(confirm("Weet je zeker dat je deze reis wilt verwijderen?")){';
        echo 'window.location.href="delete.php?id=' . $id . '&confirm=yes";';
        echo '} else {';
          echo 'window.location.href="adminpanel.php"';
        echo '}';
        echo '</script>';
    }
?>
