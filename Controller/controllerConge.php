<?php
include '../Model/connexion.php';
include '../Model/modelConge.php';
include '../Model/modelPersonnel.php';

if (isset($_POST['ajouter'])) {
    $personnelId = $_POST['personnel'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $idType = $_POST['typeConge'];

    $personnel = new Personnel();
    $result = $personnel->AfficherM($personnelId);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    $dateEmbauche = new DateTime($data['Date_d_embauche']);
    $dateActuelle = new DateTime();
    $interval = $dateEmbauche->diff($dateActuelle);
    $anneesService = $interval->y;

    if ($anneesService >= 1) {
        $conge = new Conge();
        $success = $conge->Insertion($personnelId, $dateDebut, $dateFin, $idType);
        if ($success) {
            header("Location: ../View/conge.php?status=succes_insert");
        } else {
            header("Location: ../View/conge.php?status=solde_error");
        }
    } else {
        header("Location: ../View/conge.php?status=service_error");
    }
} else {
    header("Location: ../View/conge.php");
}
