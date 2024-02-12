<?php

// Include class autoloader
include_once("../includes/autoloader.inc.php");

// Create Account Object & Fill entry when clicked
$profile = new Profile($_POST["firstName"] ?? '', $_POST["lastName"] ?? '', $_POST["email"] ?? '', $_POST["password"] ?? '', $_POST["confirmPassword"] ?? '', $_COOKIE["customerID"] ?? '');

// Account password update
if (isset($_POST["btnSubmitPassword"])) {
    // validate updated info
}

// Redirect if not logged in
if (!isset($_COOKIE["customerID"])) {
    header("Location:../pages/account.php?type=register");
    exit();
}

// Logout
if (isset($_GET["type"]) && $_GET["type"] == "logout") {
    $profile->deleteCookies();
    header("Location:account.php?type=register");
    exit();
}

// Create Object
$webpage = new Webpage('Profile - Bean and Brew', "account");
$webpage->setScript("../scripts/profile.js");
$webpage->setStyleSheet("../styles/account.css");

// Include Header
include_once("../includes/header.inc.php");
?>

<!-- Main Section -->
<main>
    <!-- Manage Account -->
    <section class="container" id="account">
        <h1 class="text-white fw-bold text-center">Manage Account Information</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Account Information Update Form -->
        <form method="POST" class="row needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- Email -->
            <div class="has-validation">
                <label for="email">Email</label>
                <input type="text" value="<?php echo $profile->getAccountValue($_COOKIE["customerID"], "email") ?>" class="form-control disable-input <?php if (isset($_POST["btnSubmit"]))  $profile->getValid("email"); ?>" value="example@beanandbew.com" name="email" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Email is invalid or taken, please try again.
                </div>
            </div>
            <!-- First name -->
            <div class="has-validation">
                <label for="firstName">First name</label>
                <input type="text" value="<?php echo $profile->getAccountValue($_COOKIE["customerID"], "firstName"); ?>" class="form-control disable-input <?php if (isset($_POST["btnSubmit"])) $profile->getValid("firstName"); ?>" value="John" name="firstName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters, please try again.
                </div>
            </div>
            <!-- Last name -->
            <div class="has-validation">
                <label for="lastName">Last name</label>
                <input type="text" value="<?php echo $profile->getAccountValue($_COOKIE["customerID"], "lastName"); ?>" class="form-control disable-input <?php if (isset($_POST["btnSubmit"])) $profile->getValid("lastName"); ?>" value="Doe" name="lastName" required>
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
            <!-- New Password -->
            <div class="has-validation">
                <label for="password">Password</label>
                <input type="password" value="<?php $profile->getValue("password"); ?>" class="form-control <?php if (isset($_POST["btnSubmitPassword"])) $profile->getValid("password"); ?>" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password must be atleast 5 characters.
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="has-validation">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" value="<?php $profile->getValue("confirmPassword"); ?>" class="form-control <?php if (isset($_POST["btnSubmitPassword"])) $profile->getValid("confirmPassword"); ?>" placeholder="Confirm Password" name="confirmPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password does not match
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnSubmitPassword">Update</button>
            </div>
        </form>
    </section>
</main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>