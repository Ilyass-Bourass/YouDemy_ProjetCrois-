<?php
    class Tag{
        private $id_tag;
        private $tag_name;
        private $connexion;

        public function __construct($db){
            $this->connexion=$db;
        }

        public function ajoutertag($tag_name){
            $sql="INSERT INTO tags(tag_name) VALUES (:tag_name)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":tag_name" => $tag_name
            ]);
            return true;
        }

        public function getALLtags(){
            $sql="SELECT * from tags";
            $query=$this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

        public function deleteTag($id_tag){
            $sql="DELETE FROM tags where id_tag=:id_tag";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_tag"=>$id_tag
            ]);
            return true;
        }
    }

?>