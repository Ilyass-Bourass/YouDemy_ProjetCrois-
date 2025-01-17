<?php
require_once '../config/dataBase.php';
require_once '../classes/Cour.php';
require_once '../classes/CourVideo.php';
require_once '../classes/CourDocument.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
   
    session_start();
    // var_dump($_SESSION);
    // var_dump($_POST);
    
    $db = new Database();
    $connex = $db->getConnection();
    
    $id_enseignant = $_SESSION['user_id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $img_url = $_POST['img_url'];
    $id_categorie = $_POST['id_categorie'];
    $prix = $_POST['prix'];
    $content_type=$_POST['content_type'];
    $content_video=$_POST['video_url'];
    $content_document=$_POST['document_content'];

    // var_dump($content_video);

    $id_tags=$_POST['tags'];
    
    foreach($id_tags as $id_tag){
        echo $id_tag;
    }

    if($content_type=="video"){
        $NewCour = new CourVideo($connex, $id_enseignant, $titre, $description, $img_url, $id_categorie, $prix);
    
        if ($NewCour->ajouterCour($id_tags,$content_video)) {
            header('Location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout du cours.";
            header('Location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        }
    }else{
        $NewCour = new CourDocument($connex, $id_enseignant, $titre, $description, $img_url, $id_categorie, $prix);
    
        if ($NewCour->ajouterCour($id_tags,$content_document)) {
            header('Location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout du cours.";
            header('Location: ../pages/Dashbord/dashbordEnseignant.php');
            exit();
        }
    }

    
}
?>
