<?php
    require_once '../config/dataBase.php';
    require_once '../classes/Categorie.php';

    if(isset($_POST['id_categorie'])){
        $id_categorie=$_POST['id_categorie'];

        $db = new Database();
        $connex = $db->getConnection();

        $newCategorie=new Categorie($connex);

        if($newCategorie->deleteCategorie($id_categorie)){
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