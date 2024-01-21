<?php
// Include the webpage class
include_once("classes/webpage.class.php");

// Create Object
$webpage = new Webpage("Home - Bean and Brew", "home");

// Include Header
include_once("./includes/header.inc.php");
include_once("./classes/product.class.php");
?>


<!-- Off Canvas -->
<div class="offcanvas offcanvas-start show" tabindex="-1" id="timetable" data-bs-theme="dark">
    <!-- Off Canvas Header -->
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Timetable</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- Off Canvas Body -->
    <div class="offcanvas-body">
        <!-- Timetable for open time -->
        <div class="card text-bg-light" style="width: 18rem;">
            <div class="card-header ">
                Weekdays
            </div>
            <ul class="list-group list-group-flush ">
                <li class="list-group-item">Monday: 9:00-17:00</li>
                <li class="list-group-item">Tuesday: 9:00-17:00</li>
                <li class="list-group-item">Wednesday: 9:00-17:00</li>
                <li class="list-group-item">Thursday: 9:00-17:00</li>
                <li class="list-group-item">Friday: 9:00-17:00</li>
            </ul>
        </div>
        <br>
        <div class="card text-bg-light" style="width: 18rem;">
            <div class="card-header">
                Weekends
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Saturday: 8:00-13:00</li>
                <li class="list-group-item">Sunday: 8:00-13:00</li>
            </ul>
        </div>
    </div>
    <!-- Embed Map -->

    <!-- Contact -->
</div>

<!-- Main Body -->
<div class="col-10 m-auto p-2 border rounded text-white">
    <!-- Top Coffee -->
    <?php
    // coffe ids = 3,6,8
    $coffee = new Product();
    $coffee->getProduct(3); ?>
    <!-- Top Baked Goods -->
    <?php
    // food ids = 22,23,31
    $bakedGoods = new Product();
    $bakedGoods->getProduct(22); ?>

</div>

<?php
// Footer 
include_once("./includes/footer.inc.php")
?>