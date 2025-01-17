<?php
     require_once '../config/dataBase.php';
     require_once '../classes/Tag.php';
 
     if(isset($_POST['tags_name'])){
         $tags_name=$_POST['tags_name'];
         $tags = explode(",", $tags_name);
         
 
         $db = new Database();
         $connex = $db->getConnection();
 
         $newTag=new Tag($connex);
         
         foreach($tags as $tag){
            $newTag->ajoutertag($tag);
         }

         header('location:../pages/Dashbord/dashbordAdmin.php');
         exit();
         }
        
?>