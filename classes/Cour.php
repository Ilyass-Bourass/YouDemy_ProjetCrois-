<?php

require_once 'CourTags.php';

    class Cour {
        private $id_cour;
        private $id_enseignant;
        private $titre;
        private $description;
        private $img_url;
        private $id_categorie;
        private $prix;
        private $conn;


        public function __construct($db,$id_enseignant,$titre,$description,$img_url,$id_categorie,$prix){
            $this->conn=$db;
            $this->id_enseignant=$id_enseignant;
            $this->titre=$titre;
            $this->description=$description;
            $this->img_url=$img_url;
            $this->id_categorie=$id_categorie;
            $this->prix=$prix;
        }

        public function ajouterCour($id_tags){
            try {
                $sql="INSERT INTO cours(id_enseignant,titre,description,img_url,id_categorie,prix)
                VALUES (:id_enseignant,:titre,:description,:img_url,:id_categorie,:prix)";
                $query=$this->conn->prepare($sql);
                $result = $query->execute([
                    ":id_enseignant"=>$this->id_enseignant,
                    ":titre"=>$this->titre,
                    ":description"=>$this->description,
                    ":img_url"=>$this->img_url,
                    ":id_categorie"=>$this->id_categorie,
                    ":prix"=>$this->prix,
                ]);
                $id_cour = $this->conn->lastInsertId();
                $courtag=new CourTag($this->conn);

                foreach($id_tags as $id_tag){
                    if(!$courtag->ajoutertagCour($id_cour,$id_tag)){
                        echo "Problem d ajout des tags";
                        exit();
                    }
                }
                return $result;
            } catch(PDOException $e) {
                return false;
            }
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

    }
?>