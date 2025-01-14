<?php 

class Utilisateur {
    private $connexion;
    private $id_utilisateur;
    private $nom;
    private $email;
    private $motpass;

    private $errors = [];
    private $errorsLogin=[];

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getErrorslogin(){
        return $this->errorsLogin;
    }

    public function register($name,$email,$password,$role){
        if(empty($name) || strlen($name)<3){
            array_push($this->errors,"le nom doit étre non vide et contient au moin 3 caractére");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errors, "Format d'email invalide");
        }

        if(empty($password) || strlen($password)<6){
            array_push($this->errors,"Le mot de passe doit comporter au moins 6 caracteres");
        }

        if(empty($role)){
            array_push($this->errors,"il faut saisir un role");
        }

        if(empty($this->errors)){
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':email' => $email]);
            $userExist = $stmt->fetch(PDO::FETCH_ASSOC);
            if($userExist){
                array_push($this->errors, "Cet email est déja enregistré");
                return false;
            }
            $passwordHash=password_hash($password,PASSWORD_BCRYPT);
            $query = "INSERT INTO users (name, email, password,role) VALUES (:name, :email, :password,:role)";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([
                ':name' => $name, 
                ':email' => $email, 
                ':password' => $passwordHash,
                ':role'=>$role
            ]);
            return true;
        }
    }

    public function signin($email, $password){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorsLogin, "Format d'email invalide");
        }
        if(empty($password)){
            array_push($this->errorsLogin, "Le mot de passe est requis");
        }

        if(empty($this->errorsLogin)){
            $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':email' => $email]);
            $userExists = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$userExists){
                array_push($this->errorsLogin, "Cet email n'a pas été trouvé");
                return false;
            }
            
            if(password_verify($password, $userExists['password'])){
                $_SESSION['is_login'] = true;
                $_SESSION['user_id'] = $userExists['id_user'];
                $_SESSION['name'] = $userExists['name'];
                $_SESSION['role'] = $userExists['role'];
                return true;
            }else {
                array_push($this->errorsLogin, "Mot de passe invalide");
                return false;
            }
        }
        return false;
    }
}
?>