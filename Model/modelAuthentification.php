<?php
include_once 'connexion.php';

class Authentification {
    private $db;

    public function __construct() {
        $this->db = Connexion::getConnexion();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM authentification WHERE username = :username AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        
        if (is_array($row)) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["password"] = $row["password"];
            $_SESSION['role'] = $row["role"];
        }
        if (isset($_SESSION["username"])) {
            return true;
        }else{
            return false;
        }
    }
}
?>