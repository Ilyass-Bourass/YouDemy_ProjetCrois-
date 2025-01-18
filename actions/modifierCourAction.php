<?php
require_once '../config/dataBase.php';
require_once '../classes/Cour.php';

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        //var_dump($_POST);
        $id_cour=$_POST['id_cour'];
        $titre=$_POST['titre'];
        $description=$_POST['description'];
        $img_url=$_POST['img_url'];
        $prix=$_POST['prix'];
        $id_categorie=$_POST['id_categorie'];
        $content_type=$_POST['content_type'];
        $document_content=$_POST['document_content'];
        $video_url=$_POST['video_url'];
        $tags_id=$_POST['tags'];

        $db = new Database();
        $connex = $db->getConnection();

        $newCour=new Cour($connex,2,$titre,$description,$img_url,$id_categorie,$prix);
        if($content_type=='DOCUMENT'){
            if($newCour->UpdateCour($id_cour,$tags_id,$content_type,$document_content)){
            //echo "la modification à été fais avec succée";
            }
        }elseif($content_type=='VIDEO'){
            if($newCour->UpdateCour($id_cour,$tags_id,$content_type,$video_url)){
                //echo "la modification à été fais avec succée";
                }
        }
        var_dump($_SESSION);

        if($_SESSION['role']==="ADMIN"){
            header('location: ../pages/Dashbord/dashbordAdmin.php');
            // echo "direction admin";
            exit();
        }else{
            header('location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        }
    }
?>