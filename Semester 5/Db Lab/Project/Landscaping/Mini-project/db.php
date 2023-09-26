<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "Gardener");

$db= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
?>