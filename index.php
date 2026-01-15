    <?php
        include "database.php";
        include "doctype.php";
        include "header.php";
        // select user info from database
        $select = mysqli_query($connection, "SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
        $join = mysqli_query($connection, "SELECT * FROM activity WHERE user_id='{$_SESSION['user_id']}' ORDER BY id DESC LIMIT 1");
        $joined = mysqli_fetch_assoc($join);
    ?>
    <?php
        if (isset($_SESSION['add-success'])) {
            echo "<div class='notice'>" . $_SESSION['add-success'] . "</div>";
            unset($_SESSION['add-success']);
        }
    ?>
    <?php if (mysqli_num_rows($select) == 1) : ?>
        <?php $user = mysqli_fetch_assoc($select); ?>
    <h1>Welcome <?php echo htmlspecialchars($user['full_name']); ?>,</h1>
    <?php if (isset($_SESSION['user_is_admin'])) : ?>
    <div class="identity">
        Year employed: <?php echo htmlspecialchars($user['year_admitted']); ?>
    </div>
    <section class="table">
        <table>
            <tr>
                <th>Employment ID:</th>
                <th>Full Name</th>
                <th>Identity ID</th>
                <th>Category</th>
                <th>Email</th>
                <th>Last activity</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($user['identity']); ?></td>
                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                <td><?php echo htmlspecialchars($user['identity_id']); ?></td>
                <td><?php echo htmlspecialchars($user['category']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($joined['date']); ?></td>
            </tr>
        </table>
    </section>
    <?php else : ?>
    <div class="identity">
        Student ID: ug22107 | Year admitted: 2022
    </div>
    <section class="table">
        <table>
            <tr>
                <th>Matric No:</th>
                <th>Progess</th>
                <th>Degree</th>
                <th>Category</th>
                <th>Admission status:</th>
                <th>Last activity</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($user['identity']); ?></td>
                <td><?php echo htmlspecialchars($user['level']); ?></td>
                <td><?php echo htmlspecialchars($user['degree']); ?></td>
                <td><?php echo htmlspecialchars($user['category']); ?></td>
                <td><?php echo htmlspecialchars($user['status']); ?></td>
                <td><?php echo htmlspecialchars($joined['date']); ?> </td>
            </tr>
        </table>
    </section>
    <?php endif; ?>
    <?php else : ?>
        <p>User not found.</p>
    <?php endif; ?>

    <?php 
        include "doc_close.php";
    ?>