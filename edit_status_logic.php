<?php
    // include files
    include "database.php";
    include "encryption.php";
    // mailer files
    include './vendor/autoload.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    // get id from url
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    } else {
        header("location: edit_status.php");
    }
    // signin function
    if (isset($_POST['submit'])) {
        // sanitize user inputs
        $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // validate input values
        if (!$status) {
            $_SESSION['edit'] = "Please fill in all required fields correctly.";
        } 
        // redirect if there's any error
        if (isset($_SESSION['edit'])) {
            header("location: edit_status.php?id=" . $id);
            die();
        } else {
            // select user email from database
            $select = mysqli_prepare($connection, "SELECT email, created_at FROM users JOIN complaints ON 
            users.id = complaints.user_id WHERE complaints.id = ?");
            mysqli_stmt_bind_param($select, "i", $id);
            mysqli_stmt_execute($select);
            $result = mysqli_stmt_get_result($select);
            $user = mysqli_fetch_assoc($result);
            // update
            $update = mysqli_prepare($connection, "UPDATE complaints SET status = ? WHERE id = ?");
            mysqli_stmt_bind_param($update, "si", $status, $id);
            mysqli_stmt_execute($update);
            // check if updated
            if (mysqli_stmt_affected_rows($update)) {
                // insert into feedback
                $insert = mysqli_prepare($connection, "INSERT INTO feedback SET complaint_id = ?");
                mysqli_stmt_bind_param($insert, "i", $id);
                mysqli_stmt_execute($insert);
                // mail message
                $mail = new PHPMailer(true);
                try {

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'jattoelvis00@gmail.com';
                    $mail->Password = '';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('jattoelvis00@gmail.com', 'CUSTECH Result Complaint Management');
                    $mail->addAddress($user['email']);

                    $mail->isHTML(true);
                    $mail->Subject = 'Result Complaint Feedback';
                    $mail->Body = 'Your result complaint made on ' . $user['created_at'] . ' has been updated. Please check your dashboard.';

                    $mail->send();
                    //echo "Email sent";

                } catch (Exception $e) {
                    echo "Error: {$mail->ErrorInfo}";
                }
                // session message and redirect
                $_SESSION['edit'] = "complaint edited successfully.";
                header("location: view.php");
                die();
            } else {
                $_SESSION['edit'] = "Failed to edit complaint. Please try again.";
                header("location: edit_status.php");
                die();
            }
        }
    } else {
        header("location: edit_status.php");
        die();
    }
    
