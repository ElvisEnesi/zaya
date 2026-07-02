    <?php
        include "database.php";
        include "doctype.php";
        include "header.php";
        // select user info from database
        $select = "SELECT * FROM users JOIN complaints ON users.id = complaints.user_id ORDER BY created_at DESC";
        $result = mysqli_query($connection, $select);//
    ?>
    <?php
        if (isset($_SESSION['edit'])) {
            echo "<div class='notice'>" . $_SESSION['edit'] . "</div>";
            unset($_SESSION['edit']);
        }
    ?>
    <section class="table">
        <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Matric No:</th>
                <th>Degree</th>
                <th>Letter</th>
                <th>Transcript</th>
                <th>False result</th>
                <th>Status</th>
                <th>Edit status</th>
                <th>Date created</th>
            </tr>
            <?php while ($details = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo htmlspecialchars($details['identity']) ?></td>
                <td><?php echo htmlspecialchars($details['degree']) ?></td>
                <td><a href="<?php echo htmlspecialchars($details['letter']) ?>" download="">Download</a></td>
                <td><a href="<?php echo htmlspecialchars($details['transcript']) ?>" download="">Download</a></td>
                <td><a href="<?php echo htmlspecialchars($details['result']) ?>" download="">Download</a></td>
                <td><?php echo htmlspecialchars($details['status']) ?></td>
                <td><a href="edit_status.php?id=<?php echo htmlspecialchars($details['id']) ?>">yes</a></td>
                <td><?php echo htmlspecialchars($details['created_at']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <div class="notice">No complaints filed yet.</div>
        <?php endif; ?>
    </section>
    <?php 
        include "doc_close.php";
    ?>