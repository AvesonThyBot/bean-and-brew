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
class Index extends Product{
    // Properties
    private $productList = [3,6,8,22,23,31];
    private $currentProduct;

    // Method to return the html code for products
    private function getHTML($type){
        echo '
        <div class="card" style="width: 18rem;">
            <img src="'. $this->currentProduct["product_image"].'" class="card-img-top" alt="'. $this->currentProduct["product_name"].'" width="100px" height="30px">
            <div class="card-body text-center">
                <h5 class="card-title">'. $this->currentProduct["product_name"].'</h5>
                <p class="card-text">'. $this->currentProduct["product_description"].'</p>
                <p class="card-text">£'. $this->currentProduct["product_price"].'</p>
                <a href="../pages/'.  $type . '?type='. strtolower($this->currentProduct['product_name']) . '" class="btn btn-outline-dark">Add</a>
            </div>
        </div>';
    }

    // Method to display top 3 coffee and baked goods in index.php
    public function getTopProducts($type){
        if ($type == "coffee") {
            for ($i=0; $i < 3; $i++) { 
                $this->currentProduct  = $this->getProduct($this->productList[$i]);
                $this->getHTML("coffee.php");
            }
        }elseif ($type == "baked"){
            for ($i=3; $i < count($this->productList); $i++) { 
                $this->currentProduct  = $this->getProduct($this->productList[$i]);
                $this->getHTML("baked.php");
            }
        }else{
            echo "There was an error!";
        }

        

        // coffe ids = 3,6,8
        // food ids = 22,23,31
    }
    
}
