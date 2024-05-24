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

    // Delete record from the database
    $sql = "DELETE FROM stargate_data WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID parameter not specified.";
    exit;
}
?>
