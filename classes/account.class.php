<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include
include_once("dbh.class.php");

// Class Login
class Login extends Dbh {
}
// Class Register
class Register extends Dbh {
}
// Class Account Management
class Account extends Dbh {
}
