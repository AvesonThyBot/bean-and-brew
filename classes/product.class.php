<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include
include_once("dbh.class.php");

// Product Class
class Product extends Dbh {
    // Method to retrieve 1 single line of data based off id
    protected function getProduct($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Method that will output every data in the database
    protected function printData() {
        $stmt = $this->connect()->query("SELECT * FROM products");
        while ($row = $stmt->fetch()) {
            echo $row["product_id"] . "<br>";
            echo $row["product_name"] . "<br>";
            echo "<img src='" . $row["product_image"] . "' width='30px' /><br>";
            echo $row["product_price"] . "<br>";
            echo $row["product_description"] . "<br>";
        }
    }
}

// Index Class
class Index extends Product {
    // Properties
    private $productList = [3, 6, 8, 12, 22, 23, 27, 31];
    private $currentProduct;
    private $discountPercentage;

    // Method to return the html code for products
    private function getHTML($type) {
        echo '
        <div class="col-md-3 col-lg-3 mb-4">
            <div class="card h-100 text-bg-white" style="width: 300px !important;">
                <img src="' . $this->currentProduct["product_image"] . '" class="card-img-top" alt="' . $this->currentProduct["product_name"] . '" width="260px" height="390px">
                <div class="card-body text-center">
                    <h5 class="card-title" data-bs-title="Name" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-delay="{&quot;show&quot;: 250, &quot;hide&quot;: 100}"
                    data-bs-animation="true" data-bs-placement="left" data-bs-content="' . $this->currentProduct["product_name"] . '">' . $this->currentProduct["product_name"] . '</h5>
                    <p class="card-text" data-bs-title="Info" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-delay="{&quot;show&quot;: 250, &quot;hide&quot;: 100}"
                    data-bs-animation="true"  data-bs-content="' . $this->currentProduct["product_description"] . '">' . $this->currentProduct["product_description"] . '</p>
                    <div class="d-flex justify-content-between align-items-center mx-auto user-select-none">
                        <div class="position-relative">
                            <span class="text-danger text-decoration-line-through fs-5">£' . $this->getDiscount(number_format($this->currentProduct['product_price'], 2)) . '</span>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . $this->discountPercentage . '</span>
                        </div>
                        <span class="text-black fs-5">£' . number_format($this->currentProduct['product_price'], 2) . '</span>
                        <a href="../pages/' . $type . '?type=' . $this->currentProduct['product_id'] . '&quantity=1" class="btn btn-outline-dark">Check Item</a>
                    </div>
                </div>
            </div>
        </div>';
    }
    // Method to get discounted amount and discount back
    private function getDiscount($price) {
        // Get random discount value
        $randomPercentage = rand(5, 70);

        // Get Fake value
        $fakeValue = round($price / (1 - ($randomPercentage / 100)), 2);

        // Return fake value and assign random percentage
        $this->discountPercentage =  '-' . $randomPercentage . '%';
        $fakeValue = round($fakeValue / 0.50) * 0.50; //make the decimal be 00,25,50 or 75
        return number_format($fakeValue, 2) - 0.01;
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
