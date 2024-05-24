<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarGejt-Přidat záznam</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<a href="./index.php" class="btn btn-primary">Main menu</a>
<a href="./logout.php" class="btn btn-primary">Log Out</a>
    <div class="container">
        <h2>Přidat záznam</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="spz">SPZ:</label>
            <input type="text" id="spz" name="spz" required><br><br>
            <label for="firma">Firma:</label>
            <input type="text" id="firma" name="firma" required><br><br>
            <label for="osoba">Osoba:</label>
            <input type="text" id="osoba" name="osoba" required><br><br>
            <label for="typ">Typ:</label>
            <input type="text" id="typ" name="typ" required><br><br>
            <label for="poznámka">Poznámka:</label>
            <input type="text" id="poznámka" name="poznámka"><br><br>
            <label for="důvod">Důvod:</label>
            <input type="text" id="důvod" name="důvod"><br><br>
            <label for="picture">Picture:</label>
            <input type="file" id="picture" name="picture" required><br><br>
            <input type="submit" value="Upload">
        </form>
    </div>
</body>
</html>