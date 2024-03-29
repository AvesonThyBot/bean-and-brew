<?php
// Include class autoloader
include_once("../includes/autoloader.inc.php");


// Create Object
$webpage = new Webpage("Coffee - Bean and Brew", "coffee");
$webpage->setScript("../scripts/product.js");
$webpage->setStyleSheet("../styles/product.css");

// Redirect if not logged in
if (!isset($_COOKIE["customerID"])) {
    header("Location:account.php?type=register");
}

// Create cart object if in item preview
if (isset($_GET["type"]) && $_GET["type"]) {
    $cart = new Cart("coffee", $_GET["type"] ?? '', $_POST["quantity"] ?? '', $_COOKIE["customerID"]);
}

// Add to cart
if (isset($_POST["btnCart"])) {
    $cart->addToCart($_COOKIE["customerID"]);
}

// Include Header
include_once("../includes/header.inc.php");
?>

<!-- Main Body -->
<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Coffee</h1>
    <hr class="border border-light border-2 opacity-50 rounded">
    <!-- Main Section -->
    <section id="main">
        <!-- Coffees -->
        <div class="row mt-4">
            <?php $coffee = new Index(); ?>
            <?php $coffee->getProductsRange(0, 20); ?>
        </div>
    </section>

    <!-- Display Product Info -->
    <section class="container" id="productInfo">
        <?php if (isset($cart)) $cart->displayContent() ?>
    </section>
</main>


<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>