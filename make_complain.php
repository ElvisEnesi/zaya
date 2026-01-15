    <?php
        include "database.php";
        include "doctype.php";
        include "header.php";
        // select user info from database
        $select = mysqli_query($connection, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
        $user_active = mysqli_fetch_assoc($select);
    ?>
    <?php
        if (isset($_SESSION['add'])) {
            echo "<div class='notice'>" . $_SESSION['add'] . "</div>";
            unset($_SESSION['add']);
        }
    ?>
    <section class="form">
        <form action="complain.php" method="post" enctype="multipart/form-data">
            <h1>Make a complain</h1>
            <input type="hidden" name="id" value="<?php echo $user_active['id'] ?>">
            <label for="letter">Complaint letter</label>
            <input type="file" name="letter">
            <label for="transcript">Transcript</label>
            <input type="file" name="transcript">
            <label for="result">Result</label>
            <input type="file" name="result">
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>
    <div class="note">
        Need help about what documents to upload? click <a href="help.php">HELP!!!</a>
    </div>
    <?php 
        include "doc_close.php";
    ?>