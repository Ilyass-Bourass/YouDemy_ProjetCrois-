<?php
    require_once '../config/dataBase.php';
    require_once '../classes/Admin.php';

    $db = new Database();
    $connex = $db->getConnection();
    $admin = new Admin($connex);

    if(isset($_POST['Supprimer']) || isset($_POST['Refuser'])){
        $Id_supprimer=$_POST['id_user'];

        if($admin->DeleteUser($Id_supprimer)){
            //echo "la suppriùé à été fais avec succées";
            header('location:../pages/Dashbord/dashbordAdmin.php');
            exit();
        }
        else{
            echo "echec de suppression";
            header('location:../pages/Dashbord/dashbordAdmin.php');
        }  
    }

    if(isset($_POST['Suspendre'])){
        $id_suspender=$_POST['id_user'];

        if($admin->Suspenderuser($id_suspender)){
            // echo "la suspendu à été fais avec succées";
            header('location:../pages/Dashbord/dashbordAdmin.php');
            exit();
        }
        else{
            echo "echec de suppression";
            header('location:../pages/Dashbord/dashbordAdmin.php');
        } 
    }

    if(isset($_POST['Activer']) || isset($_POST['Valider'])){
        $id_suspender=$_POST['id_user'];

        if($admin->activerUser($id_suspender)){
            // echo "l'activation ou validation à été fais avec succées";
            header('location:../pages/Dashbord/dashbordAdmin.php');
            exit();
        }
        else{
            echo "echec l'activation ou validation";
            header('location:../pages/Dashbord/dashbordAdmin.php');
        } 
    }

?>