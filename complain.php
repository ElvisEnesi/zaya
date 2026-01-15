<?php
    // include files
    include "database.php";
    include "encryption.php";
    // signin function
    if (isset($_POST['submit'])) {
        // sanitize user inputs
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $result = $_FILES['result'];
        $letter = $_FILES['letter'];
        $transcript = $_FILES['transcript'];
        // validate input values
        if (!$id || !$transcript['name'] || !$letter['name'] || !$result['name']) {
            $_SESSION['add'] = "Please fill in all required fields correctly.";
        } else {
            $image_name_1 = $transcript['name'];
            $image_tmp_name_1 = $transcript['tmp_name'];   
            $image_name_1_path = "uploads/" . $image_name_1; 
            $allowed_types_1 = ['jpeg', 'jpg', 'png', 'doc', 'docx','pdf'];
            $file_extension_1 = pathinfo($image_name_1, PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension_1), $allowed_types_1)) {
                $_SESSION['add'] = "Transcript file type not allowed. Allowed types: " . implode(", ", $allowed_types_1);
            } 
            $image_name_2 = $letter['name'];
            $image_tmp_name_2 = $letter['tmp_name'];
            $image_name_2_path = "uploads/" . $image_name_2;
            $allowed_types_2 = ['jpeg', 'jpg', 'png', 'doc', 'docx','pdf'];
            $file_extension_2 = pathinfo($image_name_2, PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension_2), $allowed_types_2)) {
                $_SESSION['add'] = "Letter file type not allowed. Allowed types: " . implode(", ", $allowed_types_2);
            } 
            $image_name_3 = $result['name'];
            $image_tmp_name_3 = $result['tmp_name']; 
            $image_name_3_path = "uploads/" . $image_name_3;
            $allowed_types_3 = ['jpeg', 'jpg', 'png', 'doc', 'docx','pdf'];
            $file_extension_3 = pathinfo($image_name_3, PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension_3), $allowed_types_3)) {
                $_SESSION['add'] = "Result file type not allowed. Allowed types: " . implode(", ", $allowed_types_3);
            } 
        }
        // redirect if there's any error
        if (isset($_SESSION['add'])) {
            header("location: make_complain.php");
            die();
        } else {
            // insert student into database
            $insert = mysqli_prepare($connection, "INSERT INTO complaints ( user_id, letter, transcript, result) 
            VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert, "isss", $id, $image_name_2_path, $image_name_1_path, $image_name_3_path);
            mysqli_stmt_execute($insert);
            // check if inserted
            if (mysqli_stmt_affected_rows($insert)) {
                // move uploaded files to server
                move_uploaded_file($image_tmp_name_1, $image_name_1_path);
                move_uploaded_file($image_tmp_name_2, $image_name_2_path);
                move_uploaded_file($image_tmp_name_3, $image_name_3_path);
                $_SESSION['add-success'] = "Complain filed successfully.";
                header("location: index.php");
                die();
            } else {
                $_SESSION['add'] = "Failed to add complain. Please try again.";
                header("location: make_complain.php");
                die();
            }
        }
    } else {
        header("location: make_complain.php");
        die();
    }
    