<?php
    require_once 'Utilsateur.php';

    class Enseignant extends Utilisateur{

        public function getMesCours($id_enseingnant){

            $sql="SELECT c.*,categories.name_categorie FROM cours c 
                    inner join categories  on c.id_categorie=categories.id_categorie
                    where c.id_enseignant=:id_enseignant";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                "id_enseignant"=>$id_enseingnant
            ]);
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>