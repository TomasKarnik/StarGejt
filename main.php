<?php
// Initialize the session
session_start();

// If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    echo "<script>window.location.href='./login.php';</script>";
    exit;
}

// Database connection
$servername = "localhost";
$username = "vratnice"; // Replace with your database username
$password = "Vratnice.Infotex1"; // Replace with your database password
$dbname = "stargatesg1"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize filter variables
$filter_spz = isset($_GET['spz']) ? $_GET['spz'] : '';
$filter_firma = isset($_GET['firma']) ? $_GET['firma'] : '';
$filter_osoba = isset($_GET['osoba']) ? $_GET['osoba'] : '';
$filter_typ = isset($_GET['typ']) ? $_GET['typ'] : '';
$filter_poznámka = isset($_GET['poznámka']) ? $_GET['poznámka'] : '';
$filter_důvod = isset($_GET['důvod']) ? $_GET['důvod'] : '';
$filter_saved_date = isset($_GET['saved_date']) ? $_GET['saved_date'] : '';

// Prepare SQL query
$sql = "SELECT id, spz, firma, osoba, typ, poznámka, důvod, saved_time, picture FROM stargate_data WHERE 1=1";

// Add filters if provided
if (!empty($filter_spz)) {
    $sql .= " AND spz = '$filter_spz'";
}
if (!empty($filter_firma)) {
    $sql .= " AND firma LIKE '%$filter_firma%'";
}
if (!empty($filter_osoba)) {
    $sql .= " AND osoba LIKE '%$filter_osoba%'";
}
if (!empty($filter_typ)) {
    $sql .= " AND typ LIKE '%$filter_typ%'";
}
if (!empty($filter_poznámka)) {
    $sql .= " AND poznámka LIKE '%$filter_poznámka%'";
}
if (!empty($filter_důvod)) {
    $sql .= " AND důvod LIKE '%$filter_důvod%'";
}
if (!empty($filter_saved_date)) {
    $sql .= " AND DATE(saved_time) = '$filter_saved_date'";
}

// Sort by saved_time in descending order (latest first)
$sql .= " ORDER BY saved_time DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stargejt Records</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<a href="./index.php" class="btn btn-primary">Home</a>
        <a href="./upload_form.php" class="btn btn-primary">Zapiš průjezd</a>
        <a href="./main.php" class="btn btn-primary">Záznamy průjezdů</a>
        <a href="./company.php" class="btn btn-primary">Firmy</a>
        <a href="./persons.php" class="btn btn-primary">Lidé</a>
        <a href="./vehicle.php" class="btn btn-primary">Vozidla</a>
        <a href="./logout.php" class="btn btn-primary">Log Out</a>
    <div class="container">
        <h2>Záznam průjezdů</h2>
        <form method="get" action="">
            <label for="spz">Filter by SPZ:</label>
            <input type="text" id="spz" name="spz" value="<?php echo $filter_spz; ?>"><br><br>
            <label for="firma">Filter by Firma:</label>
            <input type="text" id="firma" name="firma" value="<?php echo $filter_firma; ?>"><br><br>
            <label for="osoba">Filter by Osoba:</label>
            <input type="text" id="osoba" name="osoba" value="<?php echo $filter_osoba; ?>"><br><br>
            <label for="typ">Filter by Typ:</label>
            <input type="text" id="typ" name="typ" value="<?php echo $filter_typ; ?>"><br><br>
            <label for="poznámka">Filter by Poznámka:</label>
            <input type="text" id="poznámka" name="poznámka" value="<?php echo $filter_poznámka; ?>"><br><br>
            <label for="důvod">Filter by Důvod:</label>
            <input type="text" id="důvod" name="důvod" value="<?php echo $filter_důvod; ?>"><br><br>
            <label for="saved_date">Filter by Saved Date:</label>
            <input type="date" id="saved_date" name="saved_date" value="<?php echo $filter_saved_date; ?>"><br><br>
            <input type="submit" value="Filter">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>SPZ</th>
                <th>Firma</th>
                <th>Osoba</th>
                <th>Typ</th>
                <th>Poznámka</th>
                <th>Důvod</th>
                <th>Saved Time</th>
                <th>Picture</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["spz"] . "</td>";
                    echo "<td>" . $row["firma"] . "</td>";
                    echo "<td>" . $row["osoba"] . "</td>";
                    echo "<td>" . $row["typ"] . "</td>";
                    echo "<td>" . $row["poznámka"] . "</td>";
                    echo "<td>" . $row["důvod"] . "</td>";
                    echo "<td>" . $row["saved_time"] . "</td>"; // Assuming saved_time is already in datetime format
                    echo "<td><img src='" . $row["picture"] . "' alt='Stargate Picture' style='max-width: 100px;'></td>";
                    echo "<td><a href='edit_record.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a></td>";
                    echo "<td><a href='delete_record.php?id=" . $row["id"] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No results found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
