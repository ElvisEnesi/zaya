<?php
    // include files
    include "database.php";
    include "encryption.php";
    // signin function
    if (isset($_POST['submit'])) {
        // sanitize user inputs
        $identity = filter_var($_POST['identity'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ug_id = filter_var($_POST['ug_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);    
        $department = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $degree = filter_var($_POST['degree'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $progress = filter_var($_POST['progress'], FILTER_SANITIZE_NUMBER_INT); 
        $year = filter_var($_POST['year'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // validate input values
        if (!$identity || !$ug_id || !$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$department || !$degree || !$progress || !$year || !$category) {
            $_SESSION['add'] = "Please fill in all required fields correctly.";
        } 
        // redirect if there's any error
        if (isset($_SESSION['add'])) {
            header("location: addstudent.php");
            die();
        } else {
            // insert student into database
            $insert = mysqli_prepare($connection, "INSERT INTO users (identity, identity_id, full_name, email, department, degree, progress, year_admitted, category) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert, "ssssssss", $identity, $ug_id, $name, $email, $department, $degree, $progress, $year, $category);
            mysqli_stmt_execute($insert);
            // check if inserted
            if (mysqli_stmt_affected_rows($insert)) {
                $_SESSION['add-success'] = "Student added successfully.";
                header("location: index.php");
                die();
            } else {
                $_SESSION['add'] = "Failed to add student. Please try again.";
                header("location: addstudent.php");
                die();
            }
        }
    } else {
        header("location: addstudent.php");
        die();
    }
    