<?php
use Dompdf\Dompdf;

require "../Public/dompdf/autoload.inc.php";
require_once "../Model/connexion.php";
require_once "../Model/modelConge.php";

$dateDebut = isset($_GET['dateDebut']) && !empty($_GET['dateDebut']) ? $_GET['dateDebut'] : '2024-01-01';
$dateFin = isset($_GET['dateFin']) && !empty($_GET['dateFin']) ? $_GET['dateFin'] : date('Y-m-d');

$formattedDateDebut = (new DateTime($dateDebut))->format('d/m/Y');
$formattedDateFin = (new DateTime($dateFin))->format('d/m/Y');

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Impression des Congés</title>
    <style>
        .no-data {text-align: center;font-style: italic;color: #888;}
        h2 {font-size: 20px;color: #555;margin: 0;text-align: center;}
        h1 {font-size: 28px;color: #333;margin: 5px 0;text-align: center;}
        body {font-family:  'Arial', sans-serif;}
        table {width: 100%;border-collapse: collapse;margin: 20px 0;}
        table,th,td {border: 1px solid black;}
        th,td {padding: 10px;text-align: center;}
        th {background-color: #f2f2f2;}
        .container {width: 80%;margin: auto;}
        .text-center {text-align: center;}
        .footer {position: absolute;bottom: 10px;left: 0;right: 0;text-align: center;font-size: 12px;color: #777;}
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Liste des Congés</h1>
        <h2 class="text-center">Du <?= $formattedDateDebut ?> au <?= $formattedDateFin ?></h2>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Personnel</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Nombre de jours</th>
                    <th>Type de congé</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conge = new Conge();
                $result = $conge->RechercherParDates($dateDebut, $dateFin);
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $dateDebutConge = (new DateTime($row['Date_de_debut']))->format('d/m/Y');
                        $dateFinConge = (new DateTime($row['Date_de_fin']))->format('d/m/Y');
                        echo "<tr>
                                <td>{$row['ID_conge']}</td>
                                <td>{$row['Nom']} {$row['Prenom']}</td>
                                <td>{$dateDebutConge}</td>
                                <td>{$dateFinConge}</td>
                                <td>{$row['Nombre_conge']}</td>
                                <td>{$row['Type_Conge']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-data'>Aucun congé trouvé pour cette période.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="footer">
            <p>Contact: IsInfo@company.com | Tel: +261 34 03 310 87</p>
        </div>
    </div>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$fichier = "Liste Congés.pdf";
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', "portrait");
$dompdf->render();
$dompdf->stream($fichier);