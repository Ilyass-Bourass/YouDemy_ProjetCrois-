<?php
    require_once '../config/dataBase.php';
    require_once '../classes/Categorie.php';

    if(isset($_POST['categorie_name'])){
        $categorie_name=$_POST['categorie_name'];

        $db = new Database();
        $connex = $db->getConnection();

        $newCategorie=new Categorie($connex);

        if($newCategorie->ajouterCategorie($categorie_name)){
            header('location:../pages/Dashbord/dashbordAdmin.php');
            exit();
        }
        else{
            // echo "echec de l\'ajout de categorie";
            header('location:../pages/Dashbord/dashbordAdmin.php');
            exit();
        }
    }
?>