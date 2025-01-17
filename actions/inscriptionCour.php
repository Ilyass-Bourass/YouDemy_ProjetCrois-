<?php
    require_once '../config/dataBase.php';
    require_once '../classes/Categorie.php';
    require_once '../classes/Etudiant.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        $db = new Database();
        $connex = $db->getConnection();

        $id_etudiant=$_GET['id_user'];
        $id_cour=$_GET['id_cour'];
        $id_enseignant=$_GET['id_enseignant'];

        var_dump($id_enseignant);

        $newEtudiant=new Etudiant($connex);
        if($newEtudiant->inscris_cour($id_etudiant,$id_cour,$id_enseignant)){
            // echo "l insertion a éte fais avec succés";
            header('location:../pages/Dashbord/dashbordEtudaint.php');
            exit();
        }
        else{
            // echo "problem d inscription d un etudiant";
            header('location:../pages/Dashbord/dashbordEtudaint.php');
            exit();
        }
    }
?>