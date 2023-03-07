<?php
require 'includes/config/database.php';
$db = connectDatabase();
$email = "correo@correo.com";
$password = "123456";
// hash password
$password = password_hash($password, PASSWORD_DEFAULT);
// create user
$query = "INSERT INTO user (email, password) VALUES ('$email', '$password')";
var_dump($password);
mysqli_query($db, $query);
echo "entra";
mysqli_close($db);
