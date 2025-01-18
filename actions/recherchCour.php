<?php
require_once '../config/dataBase.php';
require_once '../classes/Cour.php';


    if($_SERVER['REQUEST_METHOD']=='POST'){

        $db = new Database();
        $connex = $db->getConnection();

        
        $titre=$_POST['titre'];

        $newCour=new Cour($connex,2,"","","",2,50);
        
    }
    
?>