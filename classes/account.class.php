<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Includes
include_once("dbh.class.php");

// Class for Account system
class Account extends Dbh {
    // Properties
    private $type;
    private $userId;
    private $firstName;
    private $lastName;
    private $email;
    private $pwd;
    private $errors = array();

    // Construct
    public function __construct($type) {
        if (in_array($type, ["login", "register", "account", "logout"])) {
            $this->type = $type;
        }
    }

    // ------------------------------ Getters & Setters ------------------------------


    // ------------------------------ General Validate Methods ------------------------------

    // Method to validate post data
    public function validateData($data) {
        if ($this->type == "login") {
            $this->validateLogin($data);
        } else if ($this->type == "register") {
            $this->validateRegister($data);
        } else if ($this->type == "account") {
            $this->validateAccount($data);
        }

        // Return if theres any errors
        print_r($this->errors);
        echo "<br>" . $this->firstName . "<br>" . $this->lastName . "<br>" . $this->email . "<br>" . $this->pwd;
    }

    // Method to validate Login
    private function validateLogin($data) {
        // Login Logic
    }

    // Method to validate Register
    private function validateRegister($data) {
        // Validate Each Inputs
        $this->validateName($data["firstName"], "firstName");
        $this->validateName($data["lastName"], "lastName");
        $this->validateEmail($data["email"]);
        $this->validatePassword($data["password"], $data["confirmPassword"]);
    }

    // Method to validate Account Update
    private function validateAccount($data) {
        // Validate Each Inputs
        $this->validateName($data["firstName"], "firstName");
        $this->validateName($data["lastName"], "lastName");
        $this->validateEmail($data["email"]);
        $this->validatePassword($data["password"], $data["confirmPassword"]);
    }

    // ------------------------------ Validate Inputs Methods ------------------------------

    // Method to Validate Name
    private function validateName($name, $type) {
        if (empty($name) || !ctype_alpha($name) || (strlen($name) < 3 || strlen($name) > 20)) {
            array_push($this->errors, $type == "firstName" ? "firstName" : "lastName");
        } else {
            $type == "firstName" ? $this->firstName = $name : $this->lastName = $name;
        }
    }

    // Method to Validate Email
    private function validateEmail($email) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, "email");
        } else {
            $this->email = $email;
        }
    }

    // Method to Validate Password
    private function validatePassword($password, $confirmPassword) {
        // Validate Password
        if (empty($password) || (strlen($password) < 5 || strlen($password) > 60) || $password !== $confirmPassword) {
            array_push($this->errors, "password");
        } else {
            $this->pwd = $password;
        }
    }

    // Method to confirm before updating info
    private function confirmUpdate() {
    }
}
