<?php
// Include the necessary class
include_once("../classes/webpage.class.php");
include_once("../classes/product.class.php");
include_once("../classes/account.class.php");


// Create Object
$webpage = new Webpage("Coffee - Bean and Brew", "coffee");
$webpage->setScript("../scripts/code.js");

// Redirect if not logged in
if (count($_COOKIE) <= 0) {
    header("Location:account.php?type=register");
}

// Include Header
include_once("../includes/header.inc.php");
?>

<!-- Main Body -->
<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Coffee</h1>
    <hr class="border border-light border-2 opacity-50 rounded">
    <!-- Coffees -->
    <div class="row mt-4">
        <?php $coffee = new Index(); ?>
        <?php $coffee->getProductsRange(0, 20); ?>
    </div>
</main>


<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>