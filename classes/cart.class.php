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
    private $item;
    private $type;
    private $quantity;

    // Construct 
    public function __construct($type, $item, $quantity) {
        // Assign type
        $this->type = $type;

        // Assign quantity
        if ($quantity > 0) {
            $this->quantity = $quantity;
        } else {
            $this->quantity = 1;
        }

        // Assign item if valid
        $this->item = $this->validateItem($item);
    }

    // Method to validate item
    private function validateItem($item) {
        if ($this->type == "baked" && ($item > 20 && $item <= 40)) {
            return $item;
        } else if ($this->type == "coffee" && ($item > 0 && $item <= 20)) {
            return $item;
        }
    }

    // GETTER method to get product information
    private function getProduct() {
        $stmt = $this->connect()->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$this->item]);
        return $stmt->fetch();
    }

    // Method to fetch existing cart data
    private function getExisting($item, $id) {
        $stmt = $this->connect()->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
        $stmt->execute([$item, $id]);
        return $stmt->fetch();
    }

    // Method to update existing cart data
    private function updateExisting($data, $id) {
        $stmt = $this->connect()->prepare("UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?");
        $newQuantity = $this->quantity + $data["quantity"];
        $stmt->execute([$newQuantity, $this->item, $id]);
    }

    // Method to add new cart data
    private function addNew($id) {
        $stmt = $this->connect()->prepare("INSERT INTO cart (product_id, user_id, quantity) VALUES (?,?,?)");
        $stmt->execute([$this->item, $id, $this->quantity]);
    }

    // Method to update/add to cart
    public function addToCart($id) {
        // check If item already in cart
        $selectResult = $this->getExisting($this->item, $id);

        // Iterate the option
        if ($selectResult !== false && isset($selectResult["user_id"]) && isset($selectResult["product_id"])) {
            // Update quantity in cart
            $this->updateExisting($selectResult, $id);
        } else {
            // Add to cart
            $this->addNew($id);
        }
    }

    // Method to display product information
    public function displayContent() {
        $results = $this->getProduct();
?>
        <div class="row d-flex">
            <!-- Image preview -->
            <div class="col-lg-6 order-lg-1">
                <img src="<?php echo $results["product_image"] ?>" alt="picture of the product" class="img-fluid">
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
                <form method="post" class="row">
                    <span class="fs-5 fw-lighten text-center">Quantity</span>
                    <div class="input-group mb-3 mt-1">
                        <button type="button" class="btn btn-danger input-group-text" id="minusBtn">&#x2212;</button>
                        <input type="text" class="form-control" placeholder="1" value="1" aria-label="Amount (to the nearest dollar)" id="number" name="quantity">
                        <button type="button" class="btn btn-success input-group-text" id="plusBtn">&#x002B;</button>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-evenly gap-2">
                        <a href="https://amazon.com" target="_blank" class="btn btn-success">Buy Now</a>
                        <button type="submit" name="btnCart" class="btn btn-light">&#128722; Add to cart</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    }
}
