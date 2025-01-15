<?php
session_start();

if (!isset($_SESSION['is_login'])) {
    header('location: ../pages/login.php');
    exit();
}

switch($_SESSION['role']) {
    case 'ETUDIANT':
        header('location: ../index.php?page=1');
        break;
    case 'ENSEIGNANT':
        header('location: ../pages/Dashbord/dashbordEnseignant.php');
        echo "enseignant";
        break;
    case 'ADMIN':
        header('location: ../pages/Dashbord/dashbordAdmin.php');
        break;
    default:
        header('location: ../pages/login.php');
        break;
}
exit();
?> 