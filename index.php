<?php
// Include the necessary class
include_once("classes/webpage.class.php");
include_once("./classes/product.class.php");

// Create Object
$webpage = new Webpage("Home - Bean and Brew", "home");
$webpage->setStyleSheet("styles/index.css");
$webpage->setScript("scripts/code.js");

// Include Header
include_once("./includes/header.inc.php");
?>
<!-- Off Canvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="timetable" data-bs-theme="dark">
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
<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Top Selling</h1>
    <hr class="border border-light border-2 opacity-50 rounded">
    <!-- Top Products -->
    <div class="row mt-4">
        <?php $topProducts = new Index(); ?>
        <?php $topProducts->getTopProducts("coffee"); ?>
        <?php $topProducts->getTopProducts("baked"); ?>
    </div>
</main>

<?php
// Footer 
include_once("./includes/footer.inc.php")
?>