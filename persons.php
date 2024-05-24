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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StarGejt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
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
            <input type="submit" name="remove_person" value="Remove Person" onclick="return confirm('Are you sure you want to remove this person?');">
        </form>

        <h2>Persons List</h2>
        <ul>
            <?php
            // Fetch persons from database
            $sql = "SELECT id, name FROM persons";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<li>ID: " . $row["id"] . " - Name: " . $row["name"] . " <a href='edit_person.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a> <form method='post' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this person?\")'> <input type='hidden' name='person_id' value='" . $row["id"] . "'> <input type='submit' name='remove_person' value='Delete' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this person?\");'></form></li>";

                }
            } else {
                echo "0 results";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$conn->close();
?>
