<?php

// Include the necessary class
include_once("../classes/webpage.class.php");

// Create Object
$webpage = new Webpage("Book A Space - Bean and Brew", "book");

// Include Header
include_once("../includes/header.inc.php");
?>


<main></main>


<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>