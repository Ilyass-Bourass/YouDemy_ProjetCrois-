<?php
    session_start();
    require_once '../config/dataBase.php';
    require_once '../classes/Utilsateur.php';

    $db = new Database();
    $connex = $db->getConnection();
    $utilisateur = new Utilisateur($connex);

    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);
        
        if($role=="ETUDIANT"){
            $register = $utilisateur->register($name, $email, $password, $role,"active");
        }
        else{
            $register = $utilisateur->register($name, $email, $password, $role,'inactive');
        }
        
        if($register){
            $_SESSION['success'] = "Compte créé avec succès!";
            header('location: ../pages/login.php');
            exit();
        }else{
            $errors = $utilisateur->getErrors();
            $_SESSION['errors'] = $errors;
            header('location: ../pages/register.php');
            exit();
        }
    }

?>