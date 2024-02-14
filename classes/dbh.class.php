<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Classes for Database Handler
class Dbh {
    // Properties
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $dbName = "babdb";

    // Method for connection to database
    protected function connect() {
        $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
 