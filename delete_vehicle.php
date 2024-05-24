<?php
// Database connection
$servername = "localhost";
$username = "vratnice"; // Replace with your database username
$password = "Vratnice.Infotex1"; // Replace with your database password
$dbname = "stargatesg1"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to delete record
    $sql = "DELETE FROM vehicles WHERE id = $id";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID parameter provided";
}

// Close connection
$conn->close();
?>
