<?php
    // include files
    include "database.php";
    include "encryption.php";
    // signin function
    if (isset($_POST['submit'])) {
        // sanitize user inputs
        $identity = filter_var($_POST['identity'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // redirect if there's any error
        if (isset($_SESSION['add'])) {
            header("location: addstudent.php");
            die();
        }
    } else {
        header("location: addstudent.php");
        die();
    }
    