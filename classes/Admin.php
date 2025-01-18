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

        public function getAllCoursAdmin(){
            $sql="SELECT c.*,cat.name_categorie,u.name from cours c join users u on u.id_user=c.id_enseignant 
                    join categories cat on c.id_categorie=cat.id_categorie;";
            $query=$this->connexion->prepare($sql);
            $query->execute();
            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

        public function isBan($id_user){
            $sql="SELECT * from users where id_user=:id_user";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                "id_user"=>$id_user
            ]);
            $result=$query->fetch(PDO::FETCH_ASSOC);
            return $result['status']==='suspendu';
        }
    }
?>