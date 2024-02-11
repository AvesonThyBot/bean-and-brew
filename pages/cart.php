<?php

// Include class autoloader
include_once("../includes/autoloader.inc.php");

// Create Object
$webpage = new Webpage("Cart - Bean and Brew", "cart");

// Redirect if not logged in
if (count($_COOKIE) <= 0) {
    header("Location:account.php?type=register");
}

// Include Header
include_once("../includes/header.inc.php");
?>

<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Shopping Cart</h1>
    <hr class="border border-light border-2 opacity-50 rounded">

</main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>