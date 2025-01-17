<?php
    require_once 'Utilsateur.php';

    class Etudiant extends Utilisateur{

        public function inscris_cour($id_etudiant,$id_cour,$id_enseignant){
            $sql="INSERT INTO inscriptions_cours(id_etudiant,id_cour,id_enseignant) VALUES (:id_etudiant,:id_cour,:id_enseignant)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_etudiant"=>$id_etudiant,
                ":id_cour"=>$id_cour,
                ":id_enseignant"=>$id_enseignant
            ]);
            return true;
        }

        public function getAllcourEtudiant($id_etudiant){
            $sql="SELECT us.name as nameEnseignant ,i.id_enseignant ,i.id_etudiant,c.titre,u.name,i.date_inscription FROM inscriptions_cours i 
                    join users u on u.id_user=i.id_etudiant
                    join cours c on c.id_cour=i.id_cour
                    join users us on us.id_user=i.id_enseignant
                    where i.id_etudiant=:id_etudiant;";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_etudiant"=>$id_etudiant
            ]);
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

    }
?>