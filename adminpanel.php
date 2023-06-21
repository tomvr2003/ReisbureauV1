<?php
session_start();
include("./components/head.php");
include("./components/header.php");
if(isset($_SESSION['isadmin'])) {
$sql = "SELECT * FROM reizen";
$statement = $conn->query($sql);
$reisbureauData = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="height: 100vh">
    <div id="admin-full-page">
        <div class="add-reis-container">
            <a href="./add-reis.php"><button class="adminpanel-button">Add Reis</button></a>
            <a href="./boekingen.php"><button class="adminpanel-button">Alle boekingen</button></a>
            <a href="./inbox.php"><button class="adminpanel-button">Inbox</button></a>
            <a href="./accounts.php"><button class="adminpanel-button">Accounts</button></a>
        </div>
        <table class="rwd-table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Reisinfo</th>
                    <th>Omschrijving</th>
                    <th>Star</th>
                    <th>Rating</th>
                    <th>Prijs</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($reisbureauData as $row) { ?>
                    <tr>
                        <td data-th="ID">
                            <?php echo $row['id']; ?>
                        </td>
                        <td data-th="Title">
                            <?php echo $row['title']; ?>
                        </td>
                        <td data-th="Reisinfo">
                            <?php echo $row['reisinfo']; ?>
                        </td>
                        <td data-th="Omschrijving">
                            <?php echo $row['omschrijving']; ?>
                        </td>
                        <td data-th="Star">
                            <?php echo $row['star']; ?>
                        </td>
                        <td data-th="Rating">
                            <?php echo $row['rating']; ?>
                        </td>
                        <td data-th="Prijs">
                            <?php echo "€ " . $row['prijs']; ?>
                        </td>
                        <td data-th="Action">
                            <a href="delete.php?id=<?php echo $row['id']; ?>"><button style="background-color: red;">Delete Reis</button></a>
                            <a href="edit.php?id=<?php echo $row['id']; ?>"><button style="background-color: #7189FF;">Edit Reis</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>


<?php
} else {
    echo "<center><h1 style='margin: 50px 0 70vh 0;'>U moet admin rechten hebben om hier in te loggen</h1></center>";
}
include("./components/footer.php");
?>
