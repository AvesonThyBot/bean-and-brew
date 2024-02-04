<?php

// Include the necessary class
include_once("../classes/account.class.php");
include_once("../classes/webpage.class.php");

// Create Account Object
if (isset($_GET["type"])) {
    switch (strtolower($_GET["type"])) {
            // Login
        case 'login':
            $account = new Login();
            break;
            // Register
        case 'register':
            $account = new Register();
            break;
            // Account Management
        case 'account':
            $account = new Account();
            break;
            // Logout
        case 'logout':
            // Logout code
            break;
    }
}

// Create Object
$webpage = new Webpage(isset($account) ? $account->getType() . "- Bean and Brew" : 'Account - Bean and Brew', "account");

// Include Header
include_once("../includes/header.inc.php");
?>

<!-- Login -->
<section class="container <?php isset($account) ? '' : ''; ?>" id="login"></section>
<!-- Register -->
<section class="container" id="register"></section>
<!-- Manage Account -->
<main class="container" id="account"></main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>