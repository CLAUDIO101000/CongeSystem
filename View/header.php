<?php
session_start();
if (!$_SESSION['username']) {
    header("Location: authentification.php");
    exit();
}
include_once '../Controller/function.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))); ?></title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Public/Sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="../Public/DataTables/datatables.min.css">
    <script src="../Public/js/jquery-3.7.1.min.js"></script>
    <script src="../Public/Chart/Chart.min.js"></script>
    <script src="../Public/js/bootstrap.bundle.js"></script>
    <script src="../Public/DataTables/datatables.min.js"></script>
    <script src="../Public/Sweetalert/sweetalert2.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="sidebar hidden-print">
        <div class="logo-details">
            <span class="logo_name">Gestion de Congés</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "dashboard.php" ? "active" : "" ?>">
                    <i class="bi bi-grid"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="conge.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "conge.php" ? "active" : "" ?>">
                    <i class='bi bi-calendar'></i>
                    <span>Congés</span>
                </a>
            </li>
            <li>
                <a href="personnel.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "personnel.php" ? "active" : "" ?>">
                    <i class="bi bi-person"></i>
                    <span>Personnel</span>
                </a>
            </li>
            <li>
                <a href="direction.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "direction.php" ? "active" : "" ?>">
                    <i class="bi bi-buildings"></i>
                    <span>Directions</span>
                </a>
            </li>
            <li>
                <a href="fonction.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "fonction.php" ? "active" : "" ?>">
                    <i class="bi bi-briefcase"></i>
                    <span>Fonctions</span>
                </a>
            </li>
            <li>
                <a href="typeConge.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "typeConge.php" ? "active" : "" ?>">
                    <i class="bi bi-clock"></i>
                    <span>Types de Congé</span>
                </a>
            </li>
            <li>
                <a href="../Controller/logout.php" class="<?php echo basename($_SERVER['PHP_SELF']) == "../Controller/logout.php" ? "active" : "" ?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">