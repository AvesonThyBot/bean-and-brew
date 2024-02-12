<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Includes
include_once("dbh.class.php");

// Class for Profile system
class Profile extends Dbh {
    // Properties
    private $type;
    private $firstName;
    private $lastName;
    private $email;
    private $pwd;
    private $userId;
    private $inputValues = [];
    private $errors = array();

    // Construct
    public function __construct($firstName, $lastName, $email, $pwd, $confirmPassword, $userId) {
        // Assign UserID
        $this->userId = $userId;

        // Hold Input Values
        $this->inputValues = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $pwd,
            'confirmPassword' => $confirmPassword,
        ];

        // Validate & Assign Input 
        $this->validateName($firstName, "firstName");
        $this->validateName($lastName, "lastName");
        $this->validateEmail($email);
        $this->validatePassword($pwd, $confirmPassword);
    }

    // ------------------------------ Getters & Setters ------------------------------

    // GETTER Method to get row of data
    private function getRowById($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM customer WHERE customerID = ?");
        $stmt->execute([$id]);
        return ($stmt->fetch());
    }

    // GETTER Method to get email
    private function getRowByEmail($email) {
        $stmt = $this->connect()->prepare("SELECT * FROM customer WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();;
    }

    // GETTER Method to get Input Values
    public function getValue($entryType) {
        echo $this->inputValues[$entryType];
    }

    // GETTER Method to get Input Values
    public function getAccountValue($id, $entryType) {
        // Get result and assign
        $result = $this->getRowById($id);

        // Iterate which value to display
        if ($this->inputValues[$entryType] == "") {
            return $result[$entryType];
        } else {
            return $this->inputValues[$entryType];
        }
    }

    // GETTER Method to set is-invalid/is-valid class
    public function getValid($entryType) {
        echo in_array($entryType, $this->errors) ? "is-invalid" : "is-valid";
    }


    // ------------------------------ Confirm Account Type Methods ------------------------------

    // Method to Update Account for user
    public function confirmAccount() {
        if (count($this->errors) == 2) {
            $stmt = $this->connect()->prepare("UPDATE customer
            SET firstName = ?,
                lastName = ?,
                email = ?
            WHERE customerID = ?");
            $result = $stmt->execute([$this->firstName, $this->lastName, $this->email, $this->userId]);
        }
        // Reassign info

    }

    // ------------------------------ Validate Inputs Methods ------------------------------

    // Method to Validate Name
    private function validateName($name, $type) {
        // Validate Name
        if (empty($name) || !ctype_alpha($name) || (strlen($name) < 3 || strlen($name) > 20)) {
            array_push($this->errors, $type == "firstName" ? "firstName" : "lastName");
        } else {
            // Assign Value
            $type == "firstName" ? $this->firstName = $name : $this->lastName = $name;
        }
    }

    // Method to Validate Email
    private function validateEmail($email) {
        $result = $this->getRowByEmail($email);
        print_r($result);
        // Validate Email   
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Email is either not taken or taken by the currently logged-in user
            if (!isset($result["customerID"]) || $result["customerID"] == $this->userId) {
                $this->email = $email;
            } else {
                // Email is taken by someone else
                array_push($this->errors, "email");
            }
        } else {
            // Invalid email format
            array_push($this->errors, "email");
        }
    }

    // Method to Validate Password
    private function validatePassword($password, $confirmPassword) {
        // Validate Password
        if (empty($password) || strlen($password) < 5) {
            array_push($this->errors, "password");
        }
        // Validate Confirmation Password
        if (empty($confirmPassword) || $password !== $confirmPassword) {
            array_push($this->errors, "confirmPassword");
        }

        // Assign Value
        if (!(in_array("password", $this->errors) || in_array("confirmPassword", $this->errors)))  $this->pwd = $password;
    }

    // ------------------------------ Other Methods ------------------------------

    // Method to DELETE cookies
    public function deleteCookies() {
        setcookie("customerID", "", time() - 3600, "/");
    }
}
