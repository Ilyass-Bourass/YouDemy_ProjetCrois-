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

        public function getAllinscription($id_enseingnant){
            $sql="SELECT  c.id_cour,u.id_user id_enseignant,ue.id_user idEtudiant,ue.name nameEtudiant, c.titre,i.date_inscription from inscriptions_cours i 
                    join cours c on c.id_cour=i.id_cour
                    join users u on u.id_user=i.id_enseignant
                    join users ue on ue.id_user=i.id_etudiant
                    where i.id_enseignant=:id_enseingnant";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_enseingnant"=>$id_enseingnant
            ]);
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

        public function TotalCoursEnsignant($id_enseingnant){
            $sql="SELECT count(*) total_inscriptions FROM youdemy.inscriptions_cours 
                  where id_enseignant=:id_enseingnant;";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_enseingnant"=>$id_enseingnant
            ]);
            return  $query->fetch(PDO::FETCH_ASSOC);
        }

        public function TotalCousEnsignnat($id_enseingnant){
            $sql="SELECT count(*) total_cours FROM youdemy.cours 
                  where id_enseignant=:id_enseingnant;";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_enseingnant"=>$id_enseingnant
            ]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }
?>