<?php

require_once 'CourTags.php';

    class Cour {
        protected $id_cour;
        protected $id_enseignant;
        protected $titre;
        protected $description;
        protected $img_url;
        protected $id_categorie;
        protected $prix;
        protected $conn;


        public function __construct($db,$id_enseignant,$titre,$description,$img_url,$id_categorie,$prix){
            $this->conn=$db;
            $this->id_enseignant=$id_enseignant;
            $this->titre=$titre;
            $this->description=$description;
            $this->img_url=$img_url;
            $this->id_categorie=$id_categorie;
            $this->prix=$prix;
        }

        public function ajouterCour($id_tags,$content){
    
        }

        public function afficherCour($id_cour){
            
        }

        public  function afficherTousLesCours($pageOffset) {
            $sql = "SELECT c.*,u.name,categories.name_categorie from cours c 
                    inner join users u on c.id_enseignant=u.id_user 
                    inner join categories  on c.id_categorie=categories.id_categorie limit 3 offset $pageOffset";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function nombreTotalcours(){
            $sql = "SELECT * FROM cours";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->rowCount();
        }

        public function deleteCour($id_cour){
            $sql="DELETE from cours where id_cour=:id_cour";
            $query=$this->conn->prepare($sql);
            $query->execute([
                ":id_cour"=>$id_cour
            ]);
            return true;
        }
    }
?>