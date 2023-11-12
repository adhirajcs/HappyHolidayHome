<?php
session_start();

$servername = "localhost"; 
$username = "adhiraj";
$password = "adhiraj"; 
$database = "hhh_db";

// Creating a connection
$con = mysqli_connect($servername, $username, $password, $database);

// Checking the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>