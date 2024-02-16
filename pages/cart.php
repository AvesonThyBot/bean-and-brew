<?php

// Include class autoloader
include_once("../includes/autoloader.inc.php");

// Create Object
$webpage = new Webpage("Cart - Bean and Brew", "cart");
$webpage->setStyleSheet("../styles/product.css");

// Redirect if not logged in
if (count($_COOKIE) <= 0) {
    header("Location:account.php?type=register");
}

// Create Cart Object
$cart = new Cart('', '', '', $_COOKIE["customerID"]);

// Update Quantity Button
if (isset($_POST["updateQuantityButton"])) {
    $cart->updateQuantity($_POST["Quantity"], $_POST["item"]);
}

// Delete Item Button
if (isset($_POST["deleteButton"])) {
    $cart->deleteItem($_POST["item"]);
}



// Include Header
include_once("../includes/header.inc.php");
?>

<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Shopping Cart</h1>
    <hr class="border border-light border-2 opacity-50 rounded">

    <!-- Cart -->
    <div class="container pb-5 mt-n2 mt-md-n3">
        <div class="row">
            <!-- Item display -->
            <div class="col-xl-9 col-md-8">
                <h2 class="h5 px-4 py-3 text-bg-light">Products</h2>
                <?php $cart->displayCart(); ?>
            </div>
            <!-- Sidebar-->
            <div class="col-xl-3 col-md-4 pt-3 pt-md-0 text-center">
                <!-- Total -->
                <h2 class="h5 px-4 py-3 text-bg-light text-center">Total</h2>
                <div class="h3 fw-semibold text-center py-3">£<?php echo $cart->getTotal() ?></div>
                <hr>
                <a class="btn btn-success" href="https://hadezz.com" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1" />
                    </svg>
                    Proceed to Checkout
                </a>
                <!-- Promocode -->
                <div class="pt-4">
                    <div class="card text-bg-dark border border-light">
                        <div class="card-header">
                            <h3 class="fw-semibold">Apply promo code</h3>
                        </div>
                        <div class="card-body border-top">
                            <input class="form-control" type="text" placeholder="Code">
                            <div class="invalid-feedback">Please provide a valid promo code!</div>
                            <button class="btn btn-outline-primary float-end mt-3" type="submit">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>