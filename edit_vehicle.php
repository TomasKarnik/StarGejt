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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the ID parameter is provided
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $spz = $_POST['spz'];
        $company = $_POST['company'];

        // Update data in database
        $sql = "UPDATE vehicles SET spz='$spz', company='$company' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: ID parameter is missing";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
</head>
<body>
<a href="./index.php" class="btn btn-primary">Home</a>
<a href="./upload_form.php" class="btn btn-primary">Zapiš průjezd</a>
        <a href="./main.php" class="btn btn-primary">Záznamy průjezdů</a>
        <a href="./company.php" class="btn btn-primary">Firmy</a>
        <a href="./persons.php" class="btn btn-primary">Lidé</a>
        a href="./vehicle.php" class="btn btn-primary">Vozidla</a>
        <a href="./logout.php" class="btn btn-primary">Log Out</a>
<a href="./index.php" class="btn btn-primary">Main menu</a>
<a href="./logout.php" class="btn btn-primary">Log Out</a>
    <h2>Edit Vehicle</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <label for="spz">SPZ:</label>
    <input type="text" id="spz" name="spz" value="<?php echo isset($_POST['spz']) ? $_POST['spz'] : ''; ?>"><br><br>
    <label for="company">Company:</label>
    <input type="text" id="company" name="company" value="<?php echo isset($_POST['company']) ? $_POST['company'] : ''; ?>"><br><br>
    <input type="submit" value="Update">
</form>

</body>
</html>
