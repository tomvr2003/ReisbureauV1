<?php
session_start();
include("./components/head.php");
include("./components/header.php");
if(isset($_SESSION['isadmin'])) {
$sql = "SELECT *,boekingen.id as boekingenid FROM boekingen 
INNER JOIN reizen on reis_id = reizen.id
INNER JOIN login on user_id = login.id";
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
                    <th>Bestemming</th>
                    <th>Locatie</th>
                    <th>Vertrekdatum</th>
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
                        <td data-th="Title">
                            <?php echo $row['title']; ?>
                        </td>
                        <td data-th="Omschrijving">
                            <?php echo $row['omschrijving']; ?>
                        </td>
                        <td data-th="Datum">
                            <?php echo $row['datum']; ?>
                        </td>
                        <td data-th="Acties">
                            <a href="deleteBoeking.php?id=<?php echo $row['boekingenid']; ?>"><button style="background-color: #7189FF;">Delete Boeking</button></a>
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
