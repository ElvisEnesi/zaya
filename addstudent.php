    <?php
        include "database.php";
        include "doctype.php";
        include "header.php";
    ?>
<body>
    <section class="form">
        <form action="" method="post">
            <h1>Add students</h1>
            <input type="text" name="identity" placeholder="Matric">
            <input type="text" name="ug_id" placeholder="UG or UE">
            <input type="text" name="name" placeholder="Full Name">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="department" placeholder="Department">
            <input type="text" name="degree" placeholder="Degree">
            <input type="number" name="progress" placeholder="level">
            <input type="text" name="year" placeholder="Year admitted">
            <select name="category">
                <option value="full_time">Full time</option>
                <option value="part_time">Part time</option>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>
</body>
</html>