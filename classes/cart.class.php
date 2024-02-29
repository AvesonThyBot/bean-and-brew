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
    private $id;
    private $quantity;
    private $total;

    // Construct 
    public function __construct($type, $item, $quantity, $id) {
        // Assign type
        $this->type = $type;

        // Assign id
        $this->id = $id;

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

    // GETTER method to get all cart items
    private function getCartItems() {
        $stmt = $this->connect()->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    // Method to fetch existing cart data
    private function getExisting() {
        $stmt = $this->connect()->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
        $stmt->execute([$this->item, $this->id]);
        return $stmt->fetch();
    }

    // SETTER Method to set current cart final total
    private function setTotal($price) {
        $this->total += $price;
    }

    // GETTER Method to set current cart final total
    public function getTotal() {
        return number_format($this->total, 2);
    }

    // GETTER Method to fetch total for the product
    private function getSubTotal($price, $quantity) {
        $subTotal = number_format(($price * $quantity), 2);

        // Add to final total
        $this->setTotal($subTotal);
        return $subTotal;
    }

    // GETTER Method to fetch existing cart data
    private function getLink($item) {
        if ($item > 0 && $item <= 20) {
            return "coffee.php?type=$item";
        } else {
            return "baked.php?type=$item";
        }
    }

    // Method to update existing cart data
    private function updateExisting($data) {
        $stmt = $this->connect()->prepare("UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?");
        $newQuantity = $this->quantity + $data["quantity"];
        $stmt->execute([$newQuantity, $this->item, $this->id]);
    }

    // Method to add new cart data
    private function addNew() {
        $stmt = $this->connect()->prepare("INSERT INTO cart (product_id, user_id, quantity) VALUES (?,?,?)");
        $stmt->execute([$this->item, $this->id, $this->quantity]);
    }

    // Method to update/add to cart
    public function addToCart() {
        // check If item already in cart
        $selectResult = $this->getExisting($this->item);

        // Iterate the option
        if ($selectResult !== false && isset($selectResult["user_id"]) && isset($selectResult["product_id"])) {
            // Update quantity in cart
            $this->updateExisting($selectResult);
        } else {
            // Add to cart
            $this->addNew($this->id);
        }
    }

    // Method to update quantity
    public function updateQuantity($quantity, $item) {
        // assign updated cart detail
        $this->item = $item;
        $selectResult = $this->getExisting($item);

        // Validate quantity
        intval($quantity);
        if ($quantity <= 0) {
            $quantity = $selectResult["quantity"];
        }

        // Iterate the option
        if ($selectResult !== false) {
            // Update quantity in cart
            $stmt = $this->connect()->prepare("UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?");
            $stmt->execute([$quantity, $this->item, $this->id]);
        }
    }

    // Method to delete item from cart
    public function deleteItem($item) {
        $stmt = $this->connect()->prepare("DELETE FROM cart WHERE product_id = ? AND user_id = ? ");
        $stmt->execute([$item, $this->id]);
    }

    // Method to display cart information
    public function displayCart() {
        // Get all cart items
        $result = $this->getCartItems();

        // Display none if theres no product
        if (count($result) == 0) {
            echo "<div class='h1 col-12 text-white text-center my-5'>No items in cart.</div>";
        }

        foreach ($result as $key => $value) {
            $this->item = $value["product_id"];
            $product = $this->getProduct();
?>
            <!-- Item-->
            <div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom">
                <div class="d-block d-sm-flex text-center text-sm-left">
                    <div class="d-block item-image"><a class="mx-auto me-sm-4" href="#"><img src="<?php echo $product["product_image"] ?>" alt="Product Image" draggable="false" /></a></div>
                    <div class="ms-2 pt-3 text-start">
                        <h3 class="fw-semibold border-0 pb-0 product-name"><?php echo $product["product_name"] ?></h3>
                        <span class="fs-6 d-block"><span class="me-2 fs-5 fw-bold">Quantity:</span><?php echo $value["quantity"] ?></span>
                        <span class="fs-6 pt-2 d-block"><span class="me-2 fs-5 fw-bold text-white">Price:</span> £<?php echo number_format($product["product_price"], 2) ?></span>
                        <span class="fs-6 pt-2 d-block"><span class="me-2 fs-5 fw-bold text-white">Total:</span> £<?php echo $this->getSubTotal($product["product_price"], $value["quantity"]) ?></span>
                    </div>
                </div>
                <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 10rem;">
                    <form method="post">
                        <!-- Set Quantity -->
                        <div class="mb-2">
                            <label for="quantity1">Set Quantity</label>
                            <input class="form-control form-control-sm" name="Quantity" type="number" id="quantity1" value="<?php echo $value["quantity"] ?>">
                        </div>
                        <!-- Hidden Value -->
                        <input type="hidden" name="item" value="<?php echo $value["product_id"] ?>" />
                        <!-- Update Button -->
                        <button name="updateQuantityButton" type="submit" class="btn btn-outline-secondary btn-sm btn-block mb-2" href="<?php echo $this->getLink($value["product_id"]) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            Update
                        </button>
                        <!-- Visit Page -->
                        <a class="btn btn-outline-secondary btn-sm btn-block mb-2" href="<?php echo $this->getLink($value["product_id"]) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
                                <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z" />
                            </svg>
                            Visit Page
                        </a>
                        <!-- Delete Button -->
                        <button name="deleteButton" class="btn btn-outline-danger btn-sm btn-block mb-2" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                            </svg>
                            Remove
                        </button>
                    </form>
                </div>
            </div>

        <?php
        }
    }

    // Method to display product information
    public function displayContent() {
        $results = $this->getProduct();
        $selectResult = $this->getExisting($this->item);
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
                    <span class="h4 fw-lighten text-start">In Cart: <?php echo $selectResult !== false ? $selectResult["quantity"] : "0"; ?></span>

                    <span class="fs-5 fw-lighten text-center">Add Quantity</span>
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
