<?php
    // include files
    include "database.php";
    include "encryption.php";
    // signin function
    if (isset($_POST['submit'])) {
        // declare variables
        $employment_id = filter_var($_POST['identity'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // check inputs
        if (!$employment_id || !$user_password) {
            $_SESSION['signin'] = "Fill all fields!!";
        } else {
            // proceed to select user
            $select = "SELECT * FROM users WHERE identity='$employment_id'";
            $query = mysqli_query($connection, $select);
            if (mysqli_num_rows($query) == 1) {
                $user = mysqli_fetch_assoc($query);
                $access_key = $user['password'];
                if ($user_password == $access_key) {
                    $_SESSION['user_id'] = $user['id'];
                    mysqli_query($connection, "INSERT INTO activity SET user_id='{$_SESSION['user_id']}'");
                    if ($user['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }
                    header("location: index.php");
                } else {
                    $_SESSION['signin'] = "Incorrect password!!";
                }
                
            } else {
                $_SESSION['signin'] = "User not found!!";
            }
        }
        // redirect if there's any error
        if (isset($_SESSION['signin'])) {
            header("location: signin.php");
            die();
        }
    } else {
        header("location: signin.php");
        die();
    }
    