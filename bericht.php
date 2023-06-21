<?php
session_start();
include("./components/head.php");
include("./components/header.php");

if(isset($_SESSION['isadmin']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM contact WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(":id", $id);
    $statement->execute();
    $reisbureauData = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="height: 83vh;">
    <div id="admin-full-page">
        <div class="add-reis-container">
            <a href="./inbox.php"><button class="adminpanel-button">Terug</button></a>
        </div>
        <table class="rwd-table">
            <tbody>
                <tr>
                    <th>Bericht</th>
                </tr>
                <?php foreach ($reisbureauData as $row) { ?>
                    <tr>
                        <td data-th="Bericht">
                            <?php echo $row['bericht']; ?>
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
