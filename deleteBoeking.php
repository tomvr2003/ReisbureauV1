<?php 
    require("./components/connection.php");
    $id = $_GET['id'];
    echo $id;
    if(isset($_GET['confirm'])) {
        $sql = 'DELETE FROM boekingen WHERE id=:id';
        $statement = $conn->prepare($sql);
        if($statement->execute([':id' => $id ])) {
            header("location:boekingen.php");
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'if(confirm("Weet je zeker dat je deze boeking wilt annuleren?")){';
        echo 'window.location.href="deleteBoeking.php?id=' . $id . '&confirm=yes";';
        echo '} else {';
          echo 'window.location.href="adminpanel.php"';
        echo '}';
        echo '</script>';
    }
?>
