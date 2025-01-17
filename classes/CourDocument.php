<?php
    require_once 'Cour.php';

    class CourDocument extends Cour {
        private $id_cour_content;
        private $content_document;

        public function ajouterCour($id_tags,$content_document){
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
                $sqlV="INSERT INTO cours_content(id_cour,content_document,cour_type) VALUES (:id_cour,:content_document,:cour_type)";
                $queryv=$this->conn->prepare($sqlV);
                $queryv->execute([
                    ":id_cour"=>$id_cour,
                    ":content_document"=>$content_document,
                    ":cour_type"=>"DOCUMENT"
                ]);
                
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

        public function afficherCour($id_cour) {
            
                $sql = "SELECT u.name, c.*, ct.content_document, ct.cour_type 
                        FROM cours c 
                        INNER JOIN cours_content ct ON c.id_cour = ct.id_cour 
                        JOIN users u ON u.id_user = c.id_enseignant 
                        WHERE c.id_cour = :id_cour";
                $query = $this->conn->prepare($sql);
                $query->execute([
                    ":id_cour" => $id_cour
                ]);
                return $query->fetch(PDO::FETCH_ASSOC); // Retourne les données
            
        }        
        
    }
?>