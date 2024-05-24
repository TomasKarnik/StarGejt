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

// Initialize variables
$id = $_GET['id'] ?? null;
$name = '';

// If ID is provided
if ($id !== null) {
    // Fetch person data from database
    $sql = "SELECT id, name FROM persons WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Fetch person details
        $row = $result->fetch_assoc();
        $name = $row['name'];
    } else {
        echo "Person not found.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}

// If form submitted for editing a person
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];

    // Update person details in the database
    $sql = "UPDATE persons SET name='$newName' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        $name = $newName; // Update name for display
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
  <title>Edit Person</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
</head>
<body>
<a href="./index.php" class="btn btn-primary">Home</a>
<a href="./upload_form.php" class="btn btn-primary">Zapiš průjezd</a>
        <a href="./main.php" class="btn btn-primary">Záznamy průjezdů</a>
        <a href="./company.php" class="btn btn-primary">Firmy</a>
        <a href="./persons.php" class="btn btn-primary">Lidé</a>
        a href="./vehicle.php" class="btn btn-primary">Vozidla</a>
        <a href="./logout.php" class="btn btn-primary">Log Out</a>
    <div class="container">
        <h2>Edit Person</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            <input type="submit" name="edit_person" value="Update Person">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
