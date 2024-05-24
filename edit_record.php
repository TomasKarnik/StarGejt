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

// Check if ID parameter exists in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve record details from the database
    $sql = "SELECT * FROM stargate_data WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch data
        $row = $result->fetch_assoc();
        $spz = $row['spz'];
        $firma = $row['firma'];
        $osoba = $row['osoba'];
        $typ = $row['typ'];
        $poznámka = $row['poznámka'];
        $důvod = $row['důvod'];
    } else {
        echo "Record not found.";
        exit;
    }
} else {
    echo "ID parameter not specified.";
    exit;
}

// Check if form is submitted for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $spz = $_POST['spz'];
    $firma = $_POST['firma'];
    $osoba = $_POST['osoba'];
    $typ = $_POST['typ'];
    $poznámka = $_POST['poznámka'];
    $důvod = $_POST['důvod'];

    // Update record in the database
    $sql = "UPDATE stargate_data SET spz='$spz', firma='$firma', osoba='$osoba', typ='$typ', poznámka='$poznámka', důvod='$důvod' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StarGejt-Edit record</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
  <script defer src="./js/script.js"></script>
</head>
<body>
    <h2>Edit Record</h2>
    <form method="post" action="">
        <label for="spz">SPZ:</label><br>
        <input type="text" id="spz" name="spz" value="<?php echo $spz; ?>"><br><br>
        <label for="firma">Firma:</label><br>
        <input type="text" id="firma" name="firma" value="<?php echo $firma; ?>"><br><br>
        <label for="osoba">Osoba:</label><br>
        <input type="text" id="osoba" name="osoba" value="<?php echo $osoba; ?>"><br><br>
        <label for="typ">Typ:</label><br>
        <input type="text" id="typ" name="typ" value="<?php echo $typ; ?>"><br><br>
        <label for="poznámka">Poznámka:</label><br>
        <input type="text" id="poznámka" name="poznámka" value="<?php echo $poznámka; ?>"><br><br>
        <label for="důvod">Důvod:</label><br>
        <input type="text" id="důvod" name="důvod" value="<?php echo $důvod; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
$conn->close();
?>
