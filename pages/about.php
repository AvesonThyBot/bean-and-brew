<?php

// Include the necessary class
include_once("../classes/webpage.class.php");

// Create Object
$webpage = new Webpage("About - Bean and Brew", "about");

// Include Header
include_once("../includes/header.inc.php")
?>



    <div class="row justify-content-center gap-5 my-3">
      <div class="card  bg-dark text-bg-dark" style="width: 18rem;">
        <div class="card-img-top ratio ratio-16x9" alt="...">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2421.485725902149!2d-1.1362267229649319!3d52.63313702784664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4877611f88221c6b%3A0xf14e5c73d70167a5!2s200%20Degrees%20Coffee%20Shop!5e0!3m2!1sen!2suk!4v1706615377239!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="card-body">
          <h5 class="card-title">Harrogate Bean and Brews</h5>
          <p class="card-text">This location in Harrow comes iwth a loevely view and a bonus on pre-booking</p>
          <a href="#" class="btn btn-primary">Book Place</a>
        </div>
      </div>
      <div class="card bg-dark text-bg-dark" style="width: 18rem;">
        <div class="card-img-top ratio ratio-16x9" alt="...">
          <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d18765.684113200485!2d-1.5507399069384367!3d53.99016298669494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sHarrowgate!5e0!3m2!1sen!2suk!4v1706023058586!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="card-body">
          <h5 class="card-title">Leeds Bean and Brews</h5>
          <p class="card-text">This location in Leeds comes iwth a loevely view and a bonus on pre-booking</p>
          <a href="#" class="btn btn-primary">Book Place</a>
        </div>
      </div>
      <div class="card bg-dark text-bg-dark" style="width: 18rem;" >
        <div class="card-img-top ratio ratio-16x9" alt="...">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9379.012439040112!2d-1.4657004478943916!3d54.00715773204525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48794c0904d12069%3A0x38a9bbcb87ed3689!2sKnaresborough!5e0!3m2!1sen!2suk!4v1706023144358!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="card-body">
          <h5 class="card-title">Knaresboriugh Bean and Brews</h5>
          <p class="card-text">This location in Knaresborough comes iwth a loevely view and a bonus on pre-booking</p>
          <a href="#"  class="btn btn-primary">Book Place</a>
        </div>
      </div>
    </div>


<?php
// Footer 
include_once("../includes/footer.inc.php")
?>