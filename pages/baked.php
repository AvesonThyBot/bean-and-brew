<?php
// Include the necessary class
include_once("../classes/webpage.class.php");
include_once("../classes/product.class.php");


// Create Object
$webpage = new Webpage("Baked Goods - Bean and Brew", "baked");
$webpage->setScript("../scripts/code.js");

// Include Header
include_once("../includes/header.inc.php")
?>

<!-- Main Body -->
<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Baked Goods</h1>
    <hr class="border border-light border-2 opacity-50 rounded">
    <!-- Baked goods -->
    <div class="row mt-4">
        <?php $baked = new Index(); ?>
        <?php $baked->getProductsRange(20, 20); ?>
    </div>
</main>

<?php
// Footer 
include_once("../includes/footer.inc.php")
?>