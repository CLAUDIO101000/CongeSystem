<?php

class Connexion {
    private static $db;

    private function __construct() {}

    public static function getConnexion() {
        if (!isset(self::$db)) {
            $nom_serveur = "localhost";
            $nom_base_de_donne = "gestion_conges";
            $utilisateur = "root";
            $motpass = "";

            try {
                self::$db = new PDO("mysql:host=$nom_serveur;dbname=$nom_base_de_donne", $utilisateur, $motpass);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$db;
    }
}
?>