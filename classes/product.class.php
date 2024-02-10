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
    protected $discountPercentage;


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

    // Method to get X-Y range products
    public function getProductsRange($start, $end) {
        $stmt = $this->connect()->prepare("SELECT * FROM products LIMIT $start,$end");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $this->getHTML($row);
        }
    }

    // Method to get discounted amount and discount back
    protected function getDiscount($price, $data) {
        // Get random discount value
        $randomPercentage = rand(5, 50);

        // Get Fake value
        $fakeValue = round($price / (1 - ($randomPercentage / 100)), 2);

        // Return fake value and assign random percentage
        $this->discountPercentage =  '-' . $randomPercentage . '%';
        $fakeValue = round($fakeValue / 0.50) * 0.50; //make the decimal be 00,25,50 or 75
        $fakeValue = number_format($fakeValue, 2);
        return $fakeValue >= $data['product_price'] ?  number_format($fakeValue, 2) + 0.99 : $fakeValue;
    }

    // Method to display Product
    private function getHTML($data) {
        echo '
        <div class="col-md-3 col-lg-3 mb-4 d-flex justify-content-center">
            <div class="card h-100 text-bg-white" style="width: 300px !important;">
                <img src="' . $data["product_image"] . '" class="card-img-top" alt="' . $data["product_name"] . '" width="260px" height="390px">
                <div class="card-body text-center">
                    <h5 class="card-title" data-bs-title="Name" data-bs-toggle="popover" data-bs-trigger="hover focus"  data-bs-delay="{&quot;show&quot;: 250, &quot;hide&quot;: 100}"
                    data-bs-animation="true" data-bs-placement="left" data-bs-content="' . $data["product_name"] . '">' . $data["product_name"] . '</h5>
                    <p class="card-text" data-bs-title="Info" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-delay="{&quot;show&quot;: 250, &quot;hide&quot;: 100}"
                    data-bs-animation="true"  data-bs-content="' . $data["product_description"] . '">' . $data["product_description"] . '</p>
                    <div class="d-flex justify-content-between align-items-center mx-auto user-select-none">
                    <div class="position-relative">
                        <span class="text-danger text-decoration-line-through fs-5">£' . $this->getDiscount(number_format($data['product_price'], 2), $data) . '</span>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">' . $this->discountPercentage . '</span>
                    </div>
                        <span class="text-black fs-5">£' . number_format($data['product_price'], 2) . '</span>
                        <a href="?type=' . $data['product_id'] . '&quantity=1" class="btn btn-outline-dark">Check Item</a>
                    </div>
                </div>
            </div>
        </div>';
    }
}
