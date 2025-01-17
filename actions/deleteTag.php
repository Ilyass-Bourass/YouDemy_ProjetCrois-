<?php
    require_once '../config/dataBase.php';
    require_once '../classes/Tag.php';

    if(isset($_POST['id_tag'])){
        $id_tag=$_POST['id_tag'];

        $db = new Database();
        $connex = $db->getConnection();

        $newTag=new Tag($connex);

        var_dump($id_tag);

        if($newTag->deleteTag($id_tag)){
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