<?php
    class categorie{
        private $id_categorie;
        private $categorie_name;
        private $connexion;

        public function __construct($db){
            $this->connexion=$db;
        }

        public function ajouterCategorie($name_categorie){
            $sql="INSERT INTO categories(name_categorie) VALUES (:name_categorie)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":name_categorie" => $name_categorie
            ]);
            return true;
        }

        public function getALLCategorie(){
            $sql="SELECT * from categories";
            $query=$this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

        public function deleteCategorie($id_categorie){
            $sql="DELETE FROM categories where id_categorie=:id_categorie";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_categorie"=>$id_categorie
            ]);
        }
        
    }

?>