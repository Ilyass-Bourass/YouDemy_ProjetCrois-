<?php
require_once '../config/dataBase.php';
require_once '../classes/Cour.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
   
    session_start();
    var_dump($_SESSION);
    var_dump($_POST);
    
    $db = new Database();
    $connex = $db->getConnection();
    
    $id_enseignant = $_SESSION['user_id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $img_url = $_POST['img_url'];
    $id_categorie = $_POST['id_categorie'];
    $prix = $_POST['prix'];
    

    $NewCour = new Cour($connex, $id_enseignant, $titre, $description, $img_url, $id_categorie, $prix);
    
    if ($NewCour->ajouterCour()) {
        header('Location: ../pages/Dashbord/dashbordEnseignant.php');
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout du cours.";
        header('Location: ../pages/Dashbord/dashbordEnseignant.php');
        exit();
    }
}
?>
