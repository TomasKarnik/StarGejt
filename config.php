<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "vratnice");
define("DB_PASSWORD", "Vratnice.Infotex1");
define("DB_NAME", "stargatesg1");

# Connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

# Check connection
if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}
