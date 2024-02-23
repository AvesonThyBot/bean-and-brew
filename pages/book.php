<?php

// Include class autoloader
include_once("../includes/autoloader.inc.php");

// Create Object
$webpage = new Webpage("Book A Space - Bean and Brew", "book");

// Redirect if not logged in
if (!isset($_COOKIE["customerID"])) {
    header("Location:account.php?type=register");
}

// Include Header
include_once("../includes/header.inc.php");
?>


<main></main>


<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>