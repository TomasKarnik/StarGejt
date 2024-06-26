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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StarGejt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>
  <div class="container">
    <div class="alert alert-success my-5">
    <img src="./img/logo-text.png" class="img-fluid rounded" alt="Logo" width="180">
      Welcome ! You are now signed in to your account.
    </div>
    <!-- User profile -->
    <div class="row justify-content-center">
      <div class="col-lg-5 text-center">
        <img src="./img/blank-avatar.jpg" class="img-fluid rounded" alt="User avatar" width="180">
        <h4 class="my-4">Hello, <?= htmlspecialchars($_SESSION["username"]); ?></h4>
        <a href="./upload_form.php" class="btn btn-primary">Add record</a>
        <a href="./main.php" class="btn btn-primary">Records</a>
        <a href="./company.php" class="btn btn-primary">Companies</a>
        <a href="./persons.php" class="btn btn-primary">Persons</a>
        <a href="./vehicle.php" class="btn btn-primary">Vehicles</a>
        <a href="./logout.php" class="btn btn-primary">Log Out</a>
      </div>
    </div>
  </div>
</body>

</html>