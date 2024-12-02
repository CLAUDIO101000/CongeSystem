<?php
include_once '../Model/connexion.php';

function getTotalPersonnel() {
    try {
        $db = Connexion::getConnexion();
        $query = "SELECT COUNT(*) AS total FROM personnel";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return 0;
    }
}

function getPersonnelPlusUnAn() {
    try {
        $db = Connexion::getConnexion();
        $query = "SELECT COUNT(*) AS plus_un_an FROM personnel WHERE YEAR(NOW()) - YEAR(Date_d_embauche) >= 1";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['plus_un_an'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return 0;
    }
}

function getPersonnelAvecConges() {
    try {
        $db = Connexion::getConnexion();
        $query = "SELECT COUNT(DISTINCT ID_Personnel) AS avec_conges FROM conge";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['avec_conges'];
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return 0;
    }
}

function getCongesParMois() {
    try {
        $db = Connexion::getConnexion();
        $query = "SELECT MONTH(Date_de_debut) AS mois, COUNT(*) AS total FROM conge GROUP BY mois";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}
?>