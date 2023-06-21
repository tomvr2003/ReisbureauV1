<?php
session_start();
include("./components/head.php");
include("./components/header.php");
if(isset($_SESSION['isadmin'])) {
$sql = "SELECT * FROM login";
$statement = $conn->query($sql);
$reisbureauData = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="height: 83vh;">
    <div id="admin-full-page">
        <div class="add-reis-container">
            <a href="./adminpanel.php"><button class="adminpanel-button">Terug</button></a>
        </div>
        <table class="rwd-table">
            <tbody>
                <tr>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Wachtwoord</th>
                    <th>Acties</th>
                </tr>
                <?php foreach ($reisbureauData as $row) { ?>
                    <tr>
                        <td data-th="Username">
                            <?php echo $row['username']; ?>
                        </td>
                        <td data-th="Email">
                            <?php echo $row['email']; ?>
                        </td>
                        <td data-th="Password">
                            <?php echo $row['password']; ?>
                        </td>
                        <td data-th="Verander">
                            <a href="veranderWachtwoord.php?id=<?php echo $row['id']; ?>"><button style="background-color: #7189FF;">Verander Wachtwoord</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>


<?php
} else {
    echo "<center><h1 style='margin-top: 50px;'>U moet admin rechten hebben om hier in te loggen</h1></center>";
}
include("./components/footer.php");
?>
