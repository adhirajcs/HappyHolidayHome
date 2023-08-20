<?php
session_start();

$servername = "localhost"; 
$username = "adhiraj";
$password = "adhiraj"; 
$database = "hhh_db";

// Creating a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Checking the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
