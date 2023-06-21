<?php
session_start();

include("./components/head.php");
include("./components/header.php");

$id = $_GET['id'];

if (isset($_POST['submit_button'])) {
    $password = $_POST["password"];

    $sql = "UPDATE login SET password=:password WHERE id=:id";
    $statement = $conn->prepare($sql);
    $statement->execute([":password" => $password, ":id" => $id]);

    header("Location: ./accounts.php");
    exit();
}

if (isset($_SESSION["isadmin"])) {
    $sql = 'SELECT * FROM login WHERE id=:id';
    $statement = $conn->prepare($sql);
    $statement->execute(['id' => $id]);
    $reis = $statement->fetch(PDO::FETCH_OBJ);
    ?>

    <main class="add-form-container">
        <form method="POST" action="" class="add-form">
            <input type="hidden" name="id" value="<?= $reis->id ?>">
            <input value="<?= $reis->password ?>" type="text" id="password" name="password">
            <button type="submit" style="background-color: #7189FF; margin-top: 20px;" name="submit_button">Submit</button>
        </form>
    </main>

<?php
} else {
    echo "<center><h1 style='margin-top: 50px;'>Je hebt geen permissie om dit gericht te bewerken</h1></center>";
    echo "<center><a href='./login.php'><button style='margin-top: 30px; color: black;' class='index-button'>Log in</button></a></center>";
}

include("./components/footer.php");
?>
