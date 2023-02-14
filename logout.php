<?php
session_start(); //start session
session_unset();
session_destroy(); // distroy all the current sessions
header("Location: login.php"); // redireted to login page
?>