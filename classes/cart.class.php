<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include
include_once("dbh.class.php");

// Cart Class
class Cart extends Dbh {
    // Properties
    private $type;
    private $quantity;


    // Construct 
    public function __construct($type) {
        // Assign type if valid
        if ($type > 0 && $type <= 40) {
            $this->type = $type;
        }
    }

    // GETTER method to get product information
    private function getProduct() {
        $stmt = $this->connect()->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$this->type]);
        return $stmt->fetch();
    }

    // Method to display product information
    public function displayContent() {
        $results = $this->getProduct();
?>
        <div class="row d-flex">
            <!-- Image preview -->
            <div class="col-lg-6 order-lg-1">
                <img src="<?php echo $results["product_image"] ?>" alt="picture of the product" class="img-fluid" width="700px" height="400px">
            </div>
            <!-- Product Information -->
            <div class="col-lg-6 order-lg-2">
                <!-- Title & Price -->
                <div class="mt-1">
                    <span class="h1 fw-bold"><?php echo $results["product_name"] ?></span>
                    <span class="ms-1">Product by <a href="https://github.com/avesonthybot" target="_blank">Aveson</a></span>
                    <div id="rating">
                        &#9733;
                        &#9733;
                        &#9733;
                        &#9733;
                        &#9734;
                    </div>
                    <span class="h5">(<?php echo rand(2, 178) ?>) Votes</span>
                    <!-- Price -->
                    <div class="float-end">
                        <span class="fs-5 fw-semibold">£<?php echo number_format($results["product_price"], 2) ?></span>
                        <span>*includes tax</span>
                    </div>
                </div>
                <hr>
                <!-- Description -->
                <div class="mt-1">
                    <span class="h5">Description</span>
                    <p><?php echo $results["product_description"] ?></p>
                </div>
                <hr>
                <!-- Buttons -->
                <div class="row">
                    <span class="fs-5 fw-lighten text-center">Quantity</span>
                    <div class="input-group mb-3 mt-1">
                        <button type="button" class="btn btn-danger input-group-text" id="minusBtn">&#x2212;</button>
                        <input type="text" class="form-control" placeholder="1" value="1" aria-label="Amount (to the nearest dollar)" id="number">
                        <button type="button" class="btn btn-success input-group-text" id="plusBtn">&#x002B;</button>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-evenly gap-2">
                        <a href="https://amazon.com" target="_blank" class="btn btn-success">Buy Now</a>
                        <button class="btn btn-light">&#128722; Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
