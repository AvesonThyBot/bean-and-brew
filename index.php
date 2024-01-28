<?php
// Include the webpage class
include_once("classes/webpage.class.php");

// Create Object
$webpage = new Webpage("Home - Bean and Brew", "home");
$webpage->setStyleSheet("styles/index.css");

// Include Header
include_once("./includes/header.inc.php");
include_once("./classes/product.class.php");
?>
<link rel="stylesheet" href="style.css">
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
<div class="col-10 m-auto p-2 border rounded text-white my-2">
    <!-- Top Products -->
    <div class="col-12">
        <?php $coffee = new Index(); ?>
        <div class="row d-flex justify-content-evenly gap-2 my-2">
            <?php $coffee->getTopProducts("coffee"); ?>
        </div>
        <div class="row d-flex justify-content-evenly gap-2 my-2">
            <?php $coffee->getTopProducts("baked"); ?>
        </div>
    </div>
</div>

<?php
// Footer 
include_once("./includes/footer.inc.php")
?>