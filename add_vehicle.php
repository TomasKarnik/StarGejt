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
    $spz = $_POST['spz'];
    $company = $_POST['company'];
    $creation_datetime = date('Y-m-d H:i:s');

    // Insert data into database
    $sql = "INSERT INTO vehicles (spz, company, creation_datetime) VALUES ('$spz', '$company', '$creation_datetime')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
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
    <h2>Add Vehicle</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="spz">SPZ:</label><br>
        <input type="text" id="spz" name="spz" required><br><br>
        <label for="company">Company:</label><br>
        <input type="text" id="company" name="company" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
