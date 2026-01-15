    <?php 
        if (!isset($_SESSION['user_id'])) {
            header("location: signin.php");
            die();
        }
    ?>
    <section class="header">
        <div class="logo">
            <img src="images/logo/CUSTECH.jpg" onclick="window.location.href='index.php'">
        </div>
        <div class="nav">
            <div class="navItems">
                <ion-icon name="home-outline"></ion-icon>
                <a href="index.php">Home</a>
            </div>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
            <div class="navItems">
                <ion-icon name="person-add-outline"></ion-icon>
                <a href="addstudent.php">Add Students</a>
            </div>
            <div class="navItems">
                <ion-icon name="book-outline"></ion-icon>
                <a href="view.php">View complains</a>
            </div>
            <?php else : ?>
            <div class="navItems">
                <ion-icon name="add-circle-outline"></ion-icon>
                <a href="make_complain.php">Make a complain</a>
            </div>
            <div class="navItems">
                <ion-icon name="folder-outline"></ion-icon>
                <a href="history.php">History</a>
            </div>
            <?php endif; ?>
            <div class="navItems">
                <ion-icon name="log-out-outline"></ion-icon>
                <a href="logout.php">Log out</a>
            </div>
        </div>
        <div class="icon" id="open" onclick="openNav()">O</div>
        <div class="icon" id="close" onclick="closeNav()">X</div>
    </section>