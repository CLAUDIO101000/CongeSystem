<?php
include '../Model/connexion.php';
include '../Model/modelTypeConge.php';

if (isset($_POST['ajoute'])) {
    $typeConge = $_POST['type_conge'];
    $description = $_POST['description'];

    $Ajoute = new TypeConge();
    $Ajoute->Insertion($typeConge, $description);

    header("Location: ../View/typeConge.php?status=succes_insert");
    exit();
}

if (isset($_POST['modification'])) {
    $id = $_POST['typeId'];
    $typeConge = $_POST['type_conge'];
    $description = $_POST['description'];

    $Modif = new TypeConge();
    $Modif->Modification($id, $typeConge, $description);

    header("Location: ../View/typeConge.php?status=succes_update");
    exit();
}

if (isset($_GET['id']) && isset($_GET['del'])) {
    $id = $_GET['id'];
    $del = new TypeConge();
    $del->del($id);

    header("Location: ../View/typeConge.php?status=succes_delete");
    exit();
}

header("Location: ../View/typeConge.php");
exit();