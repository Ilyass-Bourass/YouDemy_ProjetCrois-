<?php 
session_start();

require_once '../config/dataBase.php';
require_once '../classes/Utilsateur.php';

$db = new Database();
$connex = $db->getConnection();
$utilisateur = new Utilisateur($connex);

$errorslogin = [];


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $signin = $utilisateur->signin($email, $password);

    if($signin){
        header('location: checkRole.php');
        exit();
    }else {
        $errorsLogin = $utilisateur->getErrorslogin();
        $_SESSION['errorsLogin'] = $errorsLogin;
        header('location: ../pages/login.php');
        exit();
    }
}

?>