<?php
   
    $host = getenv('DB_HOST') ?: 'localhost'; 
    $username = getenv('DB_USER') ?: 'root';  
    $password = getenv('DB_PASS') ?: '';     
    $dbname = getenv('DB_NAME') ?: 'store'; 

    $con = new mysqli($host, $username, $password, $dbname);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    session_start();
    $array = $con->query("SELECT * FROM users WHERE id ='$_SESSION[userId]'");
    $user = $array->fetch_assoc();

    $base_path = getenv('BASE_URL') ?: 'https://www.example.com/store'; // Replace with your production URL

?>
