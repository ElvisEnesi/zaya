<?php
    include "database.php";
    session_destroy();
    header("location: signin.php");