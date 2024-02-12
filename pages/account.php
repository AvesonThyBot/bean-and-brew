<?php

// Include class autoloader
include_once("../includes/autoloader.inc.php");

// Create Account Object & Fill entry when clicked
$account = new Account($_POST["firstName"] ?? '', $_POST["lastName"] ?? '', $_POST["email"] ?? '', $_POST["password"] ?? '', $_POST["confirmPassword"] ?? '', $_GET["type"] ?? '', $_COOKIE["customerID"] ?? '');

// Account Type Handler
if (isset($_POST["btnSubmit"])) {
    switch ($account->getType()) {
        case 'login': // confirm login
            $result = $account->confirmLogin();
            if ($result) {
                $account->createCookies();
                header("Location:../index.php");
                exit();
                break;
            }
            break;
        case 'register': // confirm register
            $result = $account->confirmRegister();
            if ($result) {
                $account->createCookies();
                header("Location:../index.php");
                exit();
                break;
            }
    }
}

// Redirect if logged in
if (isset($_COOKIE["customerID"])) {
    header("Location:../index.php");
    exit();
} else if (!isset($_COOKIE["customerID"]) && !isset($_GET["type"])) {
    header("Location:account.php?type=register");
    exit();
}


// Create Object
$webpage = new Webpage('Account - Bean and Brew', "account");
$webpage->setScript("../scripts/account.js");
$webpage->setStyleSheet("../styles/account.css");

// Include Header
include_once("../includes/header.inc.php");
?>

<!-- Main Section -->
<main>
    <!-- Login -->
    <section class="container d-none" id="login">
        <h1 class="text-white fw-bold text-center">Login</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Login Form -->
        <form method="POST" class="row g-3 needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- Email -->
            <div class="has-validation">
                <label for="email">Email</label>
                <input type="email" value="<?php $account->getValue("email"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("email"); ?>" placeholder="example@beanandbrew.com" name="email" required>
            </div>
            <!-- Password -->
            <div class="has-validation">
                <label for="password" class="form-label">Password</label>
                <input value="<?php $account->getValue("password"); ?>" type="password" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("password"); ?>" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Invalid login credentials
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnSubmit">Login</button>
            </div>
        </form>

    </section>

    <!-- Register -->
    <section class="container d-none" id="register">
        <h1 class="text-white fw-bold text-center">Register</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Registry Form -->
        <form method="POST" class="row g-3 needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- First Name -->
            <div class="has-validation">
                <label for="firstName">First name</label>
                <input type="text" value="<?php $account->getValue("firstName"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("firstName"); ?>" placeholder="John" name="firstName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters.
                </div>
            </div>
            <!-- Last Name -->
            <div class="has-validation">
                <label for="lastName">Last name</label>
                <input type="text" value="<?php $account->getValue("lastName"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("lastName"); ?>" placeholder="Doe" name="lastName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters.
                </div>
            </div>
            <!-- Email -->
            <div class="has-validation">
                <label for="email">Email</label>
                <input type="email" value="<?php $account->getValue("email"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("email"); ?>" placeholder="example@beanandbrew.com" name="email" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Email is invalid or taken, please try again.
                </div>
            </div>
            <!-- Password -->
            <div class="has-validation">
                <label for="password">Password</label>
                <input type="password" value="<?php $account->getValue("password"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("password"); ?>" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password must be atleast 5 characters.
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="has-validation">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" value="<?php $account->getValue("confirmPassword"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("confirmPassword"); ?>" placeholder="Confirm Password" name="confirmPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password does not match
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnSubmit">Register</button>
            </div>
        </form>
    </section>
</main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>