<?php
include '../Model/connexion.php';
include '../Model/modelPersonnel.php';

if (isset($_POST['ajoute'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dnais = $_POST['dnais'];
    $demb = $_POST['demb'];
    $adr = $_POST['adr'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $direction = $_POST['comboDirection'];
    $fonction = $_POST['comboFonction'];
    $Ajoute = new Personnel();
    $insert = $Ajoute->Insertion($nom, $prenom, $dnais, $demb, $adr, $email, $contact, $direction, $fonction);
    header("Location: ../View/personnel.php?status=succes_insert");
    exit();
} elseif (isset($_POST['modification'])) {
    $id = $_POST['matrP'];
    $nom = $_POST['nomP'];
    $prenom = $_POST['prenomP'];
    $dnais = $_POST['dnaisP'];
    $demb = $_POST['dembP'];
    $adr = $_POST['adrP'];
    $contact = $_POST['contactP'];
    $email = $_POST['emailP'];
    $direction = $_POST['comboDirectionP'];
    $fonction = $_POST['comboFonctionP'];
    $Modif = new Personnel();
    $Modification = $Modif->Modification($id, $nom, $prenom, $dnais, $demb, $adr, $email, $contact, $direction, $fonction);
    header("Location: ../View/personnel.php?status=succes_update");
    exit();
}

if (isset($_GET['id']) && isset($_GET['del'])) {
    $id = $_GET['id'];
    $del = new Personnel();
    $sup = $del->del($id);
    header("Location: ../View/personnel.php?status=succes_delete");
    exit();
}
else {
    header("Location: ../View/personnel.php");
    exit();
}

