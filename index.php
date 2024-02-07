<?php
// Include the necessary class
include_once("classes/webpage.class.php");
include_once("./classes/product.class.php");
include_once("./classes/account.class.php");

// Create Object
$webpage = new Webpage("Home - Bean and Brew", "home");
$webpage->setStyleSheet("styles/index.css");
$webpage->setScript("scripts/code.js");

// Redirect if not logged in
if (count($_COOKIE) <= 0) {
    header("Location:../pages/account.php?type=register");
}

// Include Header
include_once("./includes/header.inc.php");

?>


<!-- Main Body -->
<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Today's Top Selling</h1>
    <hr class="border border-light border-2 opacity-50 rounded">
    <!-- Top Products -->
    <div class="row mt-4">
        <?php $topProducts = new Index(); ?>
        <?php $topProducts->getTopProducts("coffee"); ?>
        <?php $topProducts->getTopProducts("baked"); ?>
    </div>
</main>

<?php
// Footer 
include_once("./includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>