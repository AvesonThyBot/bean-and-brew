<?php // Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php $webpage->getTitle() ?></title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="bg-dark">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-pills" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="/images/logo.png" class="img-fluid user-select-none" alt="Bean and Brew" width="50" draggable="false" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Optiobns -->
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link <?php $webpage->setActive("home") ?>" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php $webpage->setActive("about") ?>" href="../pages/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php $webpage->setActive("coffee") ?>" href="../pages/coffee.php">Coffee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php $webpage->setActive("baked") ?>" href="../pages/baked.php">Baked Goods</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php $webpage->setActive("book") ?>" href="../pages/book.php">Book A Space</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>