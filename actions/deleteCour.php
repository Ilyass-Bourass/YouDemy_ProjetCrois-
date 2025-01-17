<?php
    require_once '../config/dataBase.php';
    require_once '../classes/Cour.php';
    session_start();
    var_dump($_POST);

    if (isset($_POST['deleteCour'])) {

        $id_courSupprimer=$_POST['deleteCour'];
        $db = new Database();
        $connex = $db->getConnection();

        $newCour= new Cour($connex,1,"","","",1,5);
        
        if ($newCour->deleteCour($id_courSupprimer)) {
            header('Location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        } else {
            $_SESSION['error'] = "Erreur lors de la suppresion du cours.";
            header('Location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        }
        
   
    }

?>