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

// Fetch records from the database
$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<a href="./index.php" class="btn btn-primary">Home</a>
<a href="./upload_form.php" class="btn btn-primary">Zapiš průjezd</a>
        <a href="./main.php" class="btn btn-primary">Záznamy průjezdů</a>
        <a href="./company.php" class="btn btn-primary">Firmy</a>
        <a href="./persons.php" class="btn btn-primary">Lidé</a>
        <a href="./vehicle.php" class="btn btn-primary">Vozidla</a>
        <a href="./logout.php" class="btn btn-primary">Log Out</a>
<a href="./index.php" class="btn btn-primary">Main menu</a>
<a href="./logout.php" class="btn btn-primary">Log Out</a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Vehicles Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>SPZ</th>
            <th>Company</th>
            <th>Creation Date</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["spz"] . "</td>";
                echo "<td>" . $row["company"] . "</td>";
                echo "<td>" . $row["creation_datetime"] . "</td>";
                echo "<td>";
                echo "<a href='edit_vehicle.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>";
                echo "<a href='delete_vehicle.php?id=" . $row["id"] . "' class='btn btn-delete'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
    <a href="add_vehicle.php" class="btn">Add Record</a>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
