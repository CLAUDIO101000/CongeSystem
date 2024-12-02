<?php
session_start();

include_once '../Model/modelAuthentification.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $auth = new Authentification();
        $result = $auth->login($username, $password);

        if ($result === true) {
            header('Location: ../View/dashboard.php');
            exit();
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
            include '../View/authentification.php';
        }
    } else {
        $error = "Veuillez entrer un nom d'utilisateur et un mot de passe.";
        include '../View/authentification.php';
    }
} else {
    header('Location: authentification.php');
    exit();
}
?>