<?php
    require_once 'Utilsateur.php';

    class Admin extends Utilisateur{


        public function getAllUsers(){
            $sql="SELECT * FROM users where status !='inactive'";
            $query=$this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listNewTeachers(){
            $sql="SELECT * FROM users where role='ENSEIGNANT' AND status='inactive'";
            $query=$this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function DeleteUser($id_user){
            $sql="DELETE from users WHERE id_user=:id_user";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user
            ]);
            return true;
        }

        public function Suspenderuser($id_user){
            $sql="UPDATE users set status='suspendu' WHERE id_user=:id_user";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user
            ]);
            return true;
        }

        public function activerUser($id_user){
            $sql="UPDATE users set status='active' WHERE id_user=:id_user";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user
            ]);
            return true;
        }


    }
?>