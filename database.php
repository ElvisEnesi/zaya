<?php   
    // start session
    session_start(); 
    // my database file
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'zayan';
    // connection
    $connection = new mysqli($server, $username, $password, $db_name);
    // check connection
    if (mysqli_error($connection)) {
        die("failed: " . mysqli_error($connection));
    }