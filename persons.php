<?php
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

// If form submitted for adding a person
if (isset($_POST['add_person'])) {
    $name = $_POST['name'];

    // Insert into database
    $sql = "INSERT INTO persons (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// If form submitted for removing a person
if (isset($_POST['remove_person'])) {
    $id = $_POST['person_id'];

    // Delete from database
    $sql = "DELETE FROM persons WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Remove Persons</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Person</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <input type="submit" name="add_person" value="Add Person">
        </form>

        <h2>Remove Person</h2>
        <form method="post">
            <label for="person_id">Person ID:</label>
            <input type="number" id="person_id" name="person_id" required>
            <input type="submit" name="remove_person" value="Remove Person">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
