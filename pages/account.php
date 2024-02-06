<?php

// Include the necessary class
include_once("../classes/account.class.php");
include_once("../classes/webpage.class.php");

// Create Account Object
if (isset($_GET["type"])) {
    $account = new Account();
}

// Logout
if (isset($_GET["type"]) && $_GET["type"] == "logout") {
    // logout code
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
                <label for="loginEmail">Email</label>
                <input type="email" value="" class="form-control" placeholder="example@beanandbrew.com" name="loginEmail" id="loginEmail" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Password -->
            <div class="has-validation">
                <label for="loginPassword" class="form-label">Password</label>
                <input value="" type="password" class="form-control" placeholder="Password_123" name="loginPassword" id="loginPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnLogin">Login</button>
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
            <div class=" has-validation">
                <label for="registerFirstName">First name</label>
                <input type="text" value="" class="form-control" placeholder="John" name="registerFirstName" id="registerFirstName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Last Name -->
            <div class="has-validation">
                <label for="registerLastName">Last name</label>
                <input type="text" value="" class="form-control" placeholder="Doe" name="registerLastName" id="registerLastName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Email -->
            <div class="has-validation">
                <label for="registerEmail">Email</label>
                <input type="email" value="" class="form-control" placeholder="example@beanandbrew.com" name="registerEmail" id="registerEmail" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Password -->
            <div class=" has-validation">
                <label for="registerPassword">Password</label>
                <input type="password" value="" class="form-control" placeholder="Password_123" name="registerPassword" id="registerPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnRegister">Register</button>
            </div>
        </form>
    </section>

    <!-- Manage Account -->
    <section class="container d-none" id="account">
        <h1 class="text-white fw-bold text-center">Manage Account</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <form method="POST" class="row needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- Email -->
            <div class="has-validation">
                <label for="accountEmail">Email</label>
                <input type="text" class="form-control" value="example@beanandbew.com" name="accountEmail" id="accountEmail" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- First name -->
            <div class="has-validation">
                <label for="accountFirstName">First name</label>
                <input type="text" class="form-control" value="John" name="accountFirstName" id="accountFirstName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Last name -->
            <div class="has-validation">
                <label for="accountLastName">Last name</label>
                <input type="text" class="form-control" value="Doe" name="accountLastName" id="accountLastName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                </div>
            </div>
            <!-- Submit -->
            <div class="text-end">
                <button type="button" class="btn btn-light">Edit</button>
                <button class="btn btn-outline-light ms-1" type="submit" name="updateBtn">Update</button>
            </div>
        </form>
    </section>
</main>

<?php
// Footer 
include_once("../includes/footer.inc.php");
unset($webpage); // Deletes Webpage object
?>