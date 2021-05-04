<?php
$host = "localhost";
$user = "root";
$password = "password";
$db = 'mysql';

// create connection string
$constr = new mysqli($host, $user, $password, $db);

// test connection
if ($constr->connect_error) {
  die("Connection failed: " . $constr->connect_error);
}
?>