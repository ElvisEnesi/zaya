    <?php
        include "database.php";
        include "doctype.php";
        include "header.php";
    ?>
    <section class="form">
        <form action="" method="post">
            <h1>Make a complain</h1>
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