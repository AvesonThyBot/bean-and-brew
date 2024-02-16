<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include
include_once("dbh.class.php");

// Index Class
class Index extends Product {
    // Properties
    private $productList = [];
    private $currentProduct;

    // Construct Method
    public function __construct() {
        // For Loop to Assign productlist with 8 products
        for ($i = 0; $i < 8; $i++) {
            $random = rand(1, 40);
            while (in_array($random, $this->productList)) {
                $random = rand(1, 40);
            }
            $this->productList[] += $random;
        }
    }

    // Method to get page name
    private function getPageName($id) {
        if ($id > 0 && $id <= 20) {
            return "coffee.php";
        } elseif ($id > 20 && $id <= 40) {
            return "baked.php";
        }
    }

    // Method to return the html code for products
    private function getHTML($type) {
        echo '
        <div class="col-md-3 col-lg-3 mb-4 d-flex justify-content-center">
            <div class="card h-100 text-bg-white" style="width: 300px !important;">
                <img src="' . $this->currentProduct["product_image"] . '" class="card-img-top" alt="' . $this->currentProduct["product_name"] . '" width="260px" height="390px">
                <div class="card-body text-center">
                    <h5 class="card-title" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-delay="{&quot;show&quot;: 250, &quot;hide&quot;: 100}"
                    data-bs-animation="true" data-bs-placement="left" data-bs-content="' . $this->currentProduct["product_name"] . '">' . $this->currentProduct["product_name"] . '</h5>
                    <p class="card-text" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-delay="{&quot;show&quot;: 250, &quot;hide&quot;: 100}"
                    data-bs-animation="true"  data-bs-content="' . $this->currentProduct["product_description"] . '">' . $this->currentProduct["product_description"] . '</p>
                    <div class="d-flex justify-content-between align-items-center mx-auto user-select-none">
                        <div class="position-relative">
                            <span class="text-danger text-decoration-line-through fs-5">£' . $this->getDiscount(number_format($this->currentProduct['product_price'], 2), $this->currentProduct) . '</span>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . $this->discountPercentage . '</span>
                        </div>
                        <span class="text-black fs-5">£' . number_format($this->currentProduct['product_price'], 2) . '</span>
                        <a href="../pages/' . $this->getPageName($this->currentProduct['product_id']) . '?type=' . $this->currentProduct['product_id'] . '" class="btn btn-outline-dark">Check Item</a>
                    </div>
                </div>
            </div>
        </div>';
    }

    // Method to display top 3 coffee and baked goods in index.php
    public function getTopProducts($type) {
        if ($type == "coffee") {
            for ($i = 0; $i < 3; $i++) {
                $this->currentProduct  = $this->getProduct($this->productList[$i]);
                $this->getHTML("coffee.php");
            }
        } elseif ($type == "baked") {
            for ($i = 3; $i < count($this->productList); $i++) {
                $this->currentProduct  = $this->getProduct($this->productList[$i]);
                $this->getHTML("baked.php");
            }
        } else {
            echo "There was an error!";
        }
        $this->currentProduct = ''; //reset data to free memory



        // coffe ids = 3,6,8
        // food ids = 22,23,31
    }
}
