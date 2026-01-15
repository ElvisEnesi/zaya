<?php
    include "database.php";
    $user_id = $_SESSION['user_id'];
    mysqli_query($connection, "INSERT INTO activity SET user_id='$user_id'");
    session_destroy();
    header("location: signin.php");