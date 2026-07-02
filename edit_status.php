<?php
    include "database.php";
    include "encryption.php";
    // get id from url
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
    } else {
        header("location: view.php");
    }
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
        if (isset($_SESSION['edit'])) {
            echo "<div class='notice'>" . $_SESSION['edit'] . "</div>";
            unset($_SESSION['edit']);
        }
    ?>
    <section class="form">
        <form action="edit_status_logic.php?id=<?php echo htmlspecialchars($id) ?>" method="post">
            <h1>Edit status</h1>
            <select name="status">
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>
</body>
</html>