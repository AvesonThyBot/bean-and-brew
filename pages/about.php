<?php

// Include the necessary class
include_once("../classes/webpage.class.php");

// Create Object
$webpage = new Webpage("About - Bean and Brew", "about");
$webpage->setStyleSheet("../styles/about.css");

// Include Header
include_once("../includes/header.inc.php")
?>

<!-- About Us Map -->
<h1 class="text-white fw-bold text-center mt-2">Locations</h1>
<hr class="border border-light border-2 opacity-50 rounded container">
<div class="col-12 row justify-content-center my-3 gap-5">
    <!-- Leicester -->
    <div class="card h-100 text-bg-white" style="width: 500px !important; ">
        <div class="card-img-top ratio ratio-16x9" alt="...">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2421.485725902149!2d-1.1362267229649319!3d52.63313702784664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4877611f88221c6b%3A0xf14e5c73d70167a5!2s200%20Degrees%20Coffee%20Shop!5e0!3m2!1sen!2suk!4v1706615377239!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="card-body">
            <h5 class="card-title">Leicester, UK</h5>
            <p class="card-text">Great place to relax and enjoy a drink. Experience the atmosphere!</p>
            <a href="../pages/book.php?location=leicester" class="btn btn-outline-dark float-end">Book Place</a>
        </div>
    </div>
    <!-- Birmingham -->
    <div class="card h-100 text-bg-white" style="width: 500px !important;">
        <div class="card-img-top ratio ratio-16x9" alt="...">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d622083.1628724562!2d-3.118915557861321!3d52.47891200725104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bdb84c512447%3A0xc71c820e50dd8abe!2s200%20Degrees%20Coffee%20Shop!5e0!3m2!1sen!2suk!4v1706717250112!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="card-body">
            <h5 class="card-title">Birmingham, UK</h5>
            <p class="card-text">Fantastic spot to unwind and enjoy a refreshing drink. Take advantage of the beautiful surroundings!</p>
            <a href="../pages/book.php?location=birmingham" class="btn btn-outline-dark float-end">Book Place</a>
        </div>
    </div>
    <!-- Nottingham -->
    <div class="card h-100 text-bg-white" style="width: 500px !important;">
        <div class="card-img-top ratio ratio-16x9" alt="...">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d622083.1628724562!2d-3.118915557861321!3d52.47891200725104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4879c3d36baa3bb3%3A0x2868cfa99d6e05de!2s200%20Degrees%20Coffee%20Shop!5e0!3m2!1sen!2suk!4v1706717271456!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="card-body">
            <h5 class="card-title">Nottingham, UK</h5>
            <p class="card-text">Charming location to unwind, enjoy a delightful drink, and revel in the breathtaking view. Make the most of your visit!</p>
            <a href="../pages/book.php?location=nottingham" class="btn btn-outline-dark float-end">Book Place</a>
        </div>
    </div>
</div>

<!-- About Us Contacts -->
<h1 class="text-white fw-bold text-center mt-2">Contacts</h1>
<hr class="border border-light border-2 opacity-50 rounded container">

<?php
// Footer 
include_once("../includes/footer.inc.php")
?>