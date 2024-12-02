<?php
include '../Model/connexion.php';
include '../Model/modelDirection.php';

if (isset($_POST['ajoute'])) {
    $direction = $_POST['direction'];
    $Ajoute = new Direction();
    try {
        $Ajoute->Insertion($direction);
    } catch (Exception $e) {
        echo "Erreur lors de l'ajout: " . $e->getMessage();
    }
    header("Location: ../View/direction.php?status=succes_insert");
    exit();
}

if (isset($_POST['modification'])) {
    $id = $_POST['dirId'];
    $direction = $_POST['direc'];

    $Modif = new Direction();
    try {
        $Modif->Modification($id, $direction);
    } catch (Exception $e) {
        echo "Erreur lors de la modification: " . $e->getMessage();
    }
    header("Location: ../View/direction.php?status=succes_update");
    exit();
}

if (isset($_GET['id']) && isset($_GET['del'])) {
    $id = $_GET['id'];
    $del = new Direction();
    try {
        $del->del($id);
    } catch (Exception $e) {
        echo "Erreur lors de la suppression: " . $e->getMessage();
    }
    header("Location: ../View/direction.php?status=succes_delete");
    exit();
}
