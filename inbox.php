<?php
session_start();
include("./components/head.php");
include("./components/header.php");
if(isset($_SESSION['isadmin'])) {
    $sql = "SELECT c.id AS contactid, c.onderwerp, c.bericht, l.username, l.email
    FROM contact c
    INNER JOIN login l ON c.user_id = l.id";
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
                    <th>Onderwerp</th>
                    <th>Bericht</th>
                </tr>
                <?php foreach ($reisbureauData as $row) { ?>
                    <tr>
                        <td data-th="Username">
                            <?php echo $row['username']; ?>
                        </td>
                        <td data-th="Email">
                            <?php echo $row['email']; ?>
                        </td>
                        <td data-th="Onderwerp">
                            <?php echo $row['onderwerp']; ?>
                        </td>
                        <td data-th="Action">
                            <a href="./bericht.php?id=<?php echo $row["contactid"] ?>"><button style="background-color: #7189FF;">Bekijk</button></a>
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
