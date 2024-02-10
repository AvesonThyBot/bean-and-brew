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
        case 'account': // confirm account update
            $account->confirmAccount();
            break;
        default: // incase its nothing or logout
            break;
    }
}

// Account password update
if (isset($_POST["btnSubmitPassword"])) {
    // validate updated info
    $account->validateUpdate($_POST["currentPassword"] ?? '', $_POST["password"] ?? '', $_POST["confirmPassword"] ?? '');
}

print_r($account->errors);
echo $account->getValid("currentPassword");

// Redirect if logged in
if (isset($_COOKIE["customerID"]) && ($_GET["type"] !== "account" && $_GET["type"] !== "logout")) {
    header("Location:../index.php");
    exit();
} else if (!isset($_COOKIE["customerID"]) && $_GET["type"] == "account") {
    header("Location:account.php?type=register");
    exit();
}

// Logout
if (isset($_GET["type"]) && $_GET["type"] == "logout") {
    $account->deleteCookies();
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

    <!-- Manage Account -->
    <section class="container d-none" id="account">
        <h1 class="text-white fw-bold text-center">Manage Account Information</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Account Information Update Form -->
        <form method="POST" class="row needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- Email -->
            <div class="has-validation">
                <label for="email">Email</label>
                <input type="text" value="<?php echo $account->getAccountValue($_COOKIE["customerID"], "email") ?>" class="form-control disable-input <?php if (isset($_POST["btnSubmit"]))  $account->getValid("email"); ?>" value="example@beanandbew.com" name="email" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Email is invalid or taken, please try again.
                </div>
            </div>
            <!-- First name -->
            <div class="has-validation">
                <label for="firstName">First name</label>
                <input type="text" value="<?php echo $account->getAccountValue($_COOKIE["customerID"], "firstName"); ?>" class="form-control disable-input <?php if (isset($_POST["btnSubmit"])) $account->getValid("firstName"); ?>" value="John" name="firstName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters, please try again.
                </div>
            </div>
            <!-- Last name -->
            <div class="has-validation">
                <label for="lastName">Last name</label>
                <input type="text" value="<?php echo $account->getAccountValue($_COOKIE["customerID"], "lastName"); ?>" class="form-control disable-input <?php if (isset($_POST["btnSubmit"])) $account->getValid("lastName"); ?>" value="Doe" name="lastName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters, please try again.
                </div>
            </div>
            <!-- Buttons -->
            <div class="text-end mt-2">
                <button type="button" class="btn btn-light" id="btnEdit">Edit</button>
                <button class="btn btn-outline-light ms-1" type="submit" name="btnSubmit">Update</button>
            </div>
        </form>

        <h1 class="text-white fw-bold text-center">Update Password</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Update Password Form -->
        <form method="POST" class="row g-3 needs-validation gap-1 d-flex justify-content-center" novalidate>

            <!-- Current Password -->
            <div class="has-validation">
                <label for="password">Current Password</label>
                <input type="password" value="" class="form-control <?php if (isset($_POST["btnSubmitPassword"])) $account->getValid("currentPassword"); ?>" placeholder="Current Password" name="currentPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password does not match.
                </div>
            </div>
            <!-- Password -->
            <div class="has-validation">
                <label for="password">Password</label>
                <input type="password" value="<?php $account->getValue("password"); ?>" class="form-control <?php if (isset($_POST["btnSubmitPassword"])) $account->getValid("password"); ?>" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password must be atleast 5 characters.
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="has-validation">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" value="<?php $account->getValue("confirmPassword"); ?>" class="form-control <?php if (isset($_POST["btnSubmitPassword"])) $account->getValid("confirmPassword"); ?>" placeholder="Confirm Password" name="confirmPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password does not match
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnSubmitPassword">Register</button>
            </div>
        </form>
    </section>
</main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>