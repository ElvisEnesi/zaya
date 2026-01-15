<?php
    include "database.php";
    include "encryption.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custech Result Complaint System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if (isset($_SESSION['signin'])) {
            echo "<div class='notice'>" . $_SESSION['signin'] . "</div>";
            unset($_SESSION['signin']);
        }
    ?>
    <section class="form">
        <form action="signin_logic.php" method="post">
            <h1>Sign in</h1>
            <input type="text" name="identity" placeholder="Matric or Employee ID">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>
    <div class="note">
        Forgotten password?? click <a href="recover.php">Recover password!!!</a>
    </div>
</body>
</html>