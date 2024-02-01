<?php

$host = 'localhost';
$username = 'root';
$password = ''; 
$database = 'shop_db';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    // If connection fails, print an error message
    die("Connection failed: " . mysqli_connect_error());
}


?>