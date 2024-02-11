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
    private $firstName;
    private $lastName;
    private $email;
    private $pwd;
    private $userId;
    private $inputValues = [];
    private $errors = array();

    // Construct
    public function __construct($firstName, $lastName, $email, $pwd, $confirmPassword, $type, $userId) {
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

        // Type Iteration
        if (in_array($type, ["login", "register", "account"])) {
            $this->type = $type;
        }

        // Assign all information
        if ($this->type == "login") {
            $this->validateLoginEmail($email);
            $this->validateLoginPassword($pwd);
        } elseif ($this->type == "register") {
            $this->validateName($firstName, "firstName");
            $this->validateName($lastName, "lastName");
            $this->validateEmail($email);
            $this->validatePassword($pwd, $confirmPassword);
        } else {
            $this->validatePassword($pwd, $confirmPassword);
        }
    }

    // ------------------------------ Getters & Setters ------------------------------

    // GETTER Method to get account type
    public function getType() {
        return $this->type;
    }

    // GETTER Method to get account name
    public function getName() {
        $stmt = $this->connect()->prepare("SELECT * FROM customer WHERE customerID = ?");
        $stmt->execute([$this->userId]);
        $result = $stmt->fetchAll();
        return in_array("firstName", $result) ? ucfirst($result["firstName"]) : "Profile";
    }

    // GETTER Method to get account name
    public function getEmail() {
        $stmt = $this->connect()->prepare("SELECT email FROM customer WHERE customerID = ?");
        $stmt->execute([$this->userId]);
        $result = $stmt->fetch();
        return ($result["email"]);
    }

    // GETTER Method to get row of data
    private function getRow($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM customer WHERE customerID = ?");
        $stmt->execute([$id]);
        return ($stmt->fetch());
    }

    // GETTER Method to get hashed password
    private function getHashedPassword($email) {
        $stmt = $this->connect()->prepare("SELECT password_text FROM customer WHERE email = ?");
        $stmt->execute([$email]);

        // Return hashed password
        return  $stmt->rowCount() !== 0 ? $stmt->fetch()["password_text"] : "";
    }

    // GETTER Method to get Input Values
    public function getValue($entryType) {
        echo $this->inputValues[$entryType];
    }

    // GETTER Method to get Input Values
    public function getAccountValue($id, $entryType) {
        // Get result and assign
        $result = $this->getRow($id);

        // Iterate which value to display
        if ($this->inputValues[$entryType] == "") {
            return $result[$entryType];
        } else {
            return $this->inputValues[$entryType];
        }
    }

    // GETTER Method to get is-invalid/is-valid for Register & Account Management
    public function getValid($entryType) {
        echo in_array($entryType, $this->errors) ? "is-invalid" : "is-valid";
    }

    // GETTER Method to get is-invalid/is-valid for Register & Account Management
    public function getValidEmail($email) {
        // Check if email is free (not taken by any other user)
        $stmt = $this->connect()->prepare("SELECT * FROM customer WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if (isset($result["customerID"]) == $this->userId || (filter_var($email, FILTER_VALIDATE_EMAIL) && isset($result["customerID"]) == $this->userId)) {
            $this->email;
        } else {
            array_push($this->errors, "email");
        }
    }

    // ------------------------------ Confirm Account Type Methods ------------------------------

    // Method to Login user
    public function confirmLogin() {
        if (count($this->errors) == 0) {
            $this->createCookies();
            return true;
        }
    }

    // Method to Register user
    public function confirmRegister() {
        if (count($this->errors) == 0) {
            // Add user
            $stmt = $this->connect()->prepare("INSERT INTO customer (firstName, lastName, email, password_text) VALUES (?,?,?,?)");
            $hashedPwd = password_hash($this->pwd, CRYPT_BLOWFISH);
            $result = $stmt->execute([$this->inputValues['firstName'], $this->inputValues['lastName'], $this->inputValues['email'], $hashedPwd]);

            // unset statement
            $stmt = null;

            // return result
            return $result;
        }
    }

    // Method to Update Account for user
    public function confirmAccount() {
        if (count($this->errors) == 2) {
            $stmt = $this->connect()->prepare("UPDATE customer
            SET firstName = ?,
                lastName = ?,
                email = ?
            WHERE customerID = ?");
            $result = $stmt->execute([$this->inputValues['firstName'], $this->inputValues['lastName'], $this->inputValues['email'], $this->userId]);
        } else if (count($this->errors) == 3) {
        }
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
        // Validate Email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $this->checkEmail($email)) {
            array_push($this->errors, "email");
        } else {
            // Assign Value
            $this->email = $email;
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

    // Method to check if email exists
    private function checkEmail($email) {
        $stmt = $this->connect()->prepare("SELECT * FROM customer WHERE email = ?");
        $stmt->execute([$email]);

        // Return boolean result if email is in use
        return $stmt->rowCount() > 0;
    }

    // Method to validate login email
    private function validateLoginEmail($email) {
        // Validate Login email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$this->checkEmail($email)) {
            array_push($this->errors, "email");
        } else {
            // Assign Value
            $this->email = $email;
        }
    }

    // Method to validate login password
    private function validateLoginPassword($pwd) {
        // Validate Password
        $hashedPwd = $this->getHashedPassword($this->email);
        if (empty($pwd) || !password_verify($pwd, $hashedPwd)) {
            array_push($this->errors, "password");
        } else {
            // Assign Value
            $this->pwd = $pwd;
        }
    }

    // ------------------------------ Other Methods ------------------------------

    // Method to CREATE cookies
    public function createCookies() {
        $stmt = $this->connect()->prepare("SELECT customerID FROM customer WHERE email = ?");
        $stmt->execute([$this->inputValues['email']]);
        $userId = $stmt->fetch();
        setcookie("customerID", $userId["customerID"], time() + (86400 * 30), "/");
    }

    // Method to DELETE cookies
    public function deleteCookies() {
        setcookie("customerID", "", time() - 3600, "/");
    }
}
