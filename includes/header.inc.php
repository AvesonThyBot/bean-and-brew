<?php // Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include class autoloader
include_once("autoloader.inc.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php $webpage->getTitle() ?></title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon" />
    <?php $webpage->getStyleSheet() ?>
    <link rel="stylesheet" href="../styles/mystyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Scrollbar Css for all pages -->
    <style>
        body::-webkit-scrollbar {
            width: .5em;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #fff;
            border-radius: 50px;
        }

        body::-webkit-scrollbar-track {
            background-color: #212529;
        }
    </style>

</head>

<body class="bg-dark text-white">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-pills" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Logo -->
            <img src="/images/logo.png" class="navbar-brand img-fluid user-select-none" alt="Bean and Brew" width="50" draggable="false" />

            <!-- Button for smaller view width -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Options -->
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link <?php echo $webpage->setActive("home") ?>" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $webpage->setActive("about") ?>" href="../pages/about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $webpage->setActive("coffee") ?>" href="../pages/coffee.php">Coffee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $webpage->setActive("baked") ?>" href="../pages/baked.php">Baked Goods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $webpage->setActive("book") ?>" href="../pages/book.php">Book A Space</a>
                    </li>
                </ul>
                <!-- Buttons -->
                <div class="d-flex gap-2 <?php echo $webpage->showButton(); ?>">
                    <!-- Shopping Cart Button-->
                    <a class="btn btn-light" href="../pages/cart.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0z" />
                        </svg>
                    </a>
                    <!-- Off Canvas Button-->
                    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#timetable">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </button>
                </div>
                <!-- Account dropdown -->
                <div class="navbar-nav m-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo $webpage->setActive("account") ? 'text-bg-light' : 'text-bg-dark'  ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end w-100 mw-100 mt-2">
                            <?php if (isset($_COOKIE["customerID"])) { ?>
                                <li><a class="dropdown-item" href="../pages/profile.php">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="../pages/profile.php?type=logout">Log out</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="../pages/account.php?type=login">Login</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="../pages/account.php?type=register">Register</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <!-- Off Canvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="timetable" data-bs-theme="dark">
        <!-- Off Canvas Header -->
        <div class="offcanvas-header ">
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
    </div>