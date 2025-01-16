<?php
    class CourTag{
        private $id_cour;
        private $id_tag;
        private $connexion;

        public function __construct($db){
            $this->connexion=$db;
        }

        public function ajoutertagCour($id_cour,$id_tag){
            $sql="INSERT INTO cours_tags VALUES (:id_cour,:id_tag)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_cour"=>$id_cour,
                ":id_tag"=>$id_tag,
            ]);
            return true;
        }

        public function getALLtagsCour($id_cour){
            $sql="SELECT t.tag_name FROM cours_tags ct 
                    inner join cours c on ct.id_cour=c.id_cour
                    inner join tags t on ct.id_tag=t.id_tag
                    where ct.id_cour=:id_cour;
                    ";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_cour"=>$id_cour
            ]);
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>