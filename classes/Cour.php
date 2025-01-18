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

        public function getdetailsCour($id_cour){
            $sql="SELECT c.*,cat.name_categorie,ct.*  from cours c 
                    join categories cat on c.id_categorie=cat.id_categorie
                    join cours_content ct on c.id_cour=ct.id_cour 
                    where c.id_cour=:id_cour;";
            $query=$this->conn->prepare($sql);
            $query->execute([
                ":id_cour"=>$id_cour
            ]);
            return $query->FETCH(PDO::FETCH_ASSOC);
        }

        private function updateCourContent($id_cour,$content,$content_type){

            if($content_type==="VIDEO"){
                $sql="UPDATE cours_content set cour_type=:cour_type,content_video_url=:content_video_url,content_document=NULL where id_cour=:id_cour";
                $query=$this->conn->prepare($sql);
                $query->execute([
                    ":id_cour"=>$id_cour,
                    ":cour_type"=>$content_type,
                    "content_video_url"=>$content
                ]);
            }
            elseif($content_type==="DOCUMENT"){
                $sql="UPDATE cours_content set cour_type=:cour_type,content_video_url=NULL,content_document=:content_document where id_cour=:id_cour";
                $query=$this->conn->prepare($sql);
                $query->execute([
                    ":id_cour"=>$id_cour,
                    ":cour_type"=>$content_type,
                    "content_document"=>$content
                ]);
            }
            return true;    
        }

        public function UpdateCour($id_cour,$tags_id,$content_type,$content){
            $sql="UPDATE 
            cours set titre=:titre,
            description=:description,
            img_url=:img_url,
            id_categorie=:id_categorie,
            prix=:prix
            where id_cour=:id_cour"
            ;

            $query=$this->conn->prepare($sql);
            $query->execute([
                ":id_cour"=>$id_cour,
                ":titre"=>$this->titre,
                ":description"=>$this->description,
                ":img_url"=>$this->img_url,
                "id_categorie"=>$this->id_categorie,
                ":prix"=>$this->prix
            ]);

            $newCourTag= new CourTag($this->conn);
            if(!$newCourTag->Updatetags($id_cour,$tags_id)){
                echo "error de l ajout des tags";
            }

            if(!$this->updateCourContent($id_cour,$content,$content_type)){
                echo "error de updater content";
            }

            return true;

        }

        public function rechercheCour($titre) {
            $sql = "SELECT c.*, u.name, categories.name_categorie 
                    FROM cours c 
                    INNER JOIN users u ON c.id_enseignant = u.id_user 
                    INNER JOIN categories ON c.id_categorie = categories.id_categorie 
                    WHERE c.titre LIKE :titre";
            $query = $this->conn->prepare($sql);
            $query->execute([
                ":titre" => '%' . $titre . '%'
            ]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

       
    }
?>