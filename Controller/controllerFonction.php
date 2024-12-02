<?php
include '../Model/connexion.php';
include '../Model/modelFonction.php';

if (isset($_POST['ajoute'])) {
    $func = $_POST['fonction'];

    $Ajoute = new Fonction();
    $Ajoute->Insertion($func);

    header("Location: ../View/fonction.php?status=succes_insert");
    exit();
}

if (isset($_POST['modification'])) {
    $id = $_POST['foncId'];
    $func = $_POST['fonction'];

    $Modif = new Fonction();
    $Modif->Modification($id, $func);

    header("Location: ../View/fonction.php?status=succes_update");
    exit();
}

if (isset($_GET['id']) && isset($_GET['del'])) {
    $id = $_GET['id'];
    $del = new Fonction();
    $del->del($id);

    header("Location: ../View/fonction.php?status=succes_delete");
    exit();
}

header("Location: ../View/fonction.php");
exit();
?>