<?php 
require_once 'model/ModelGeneric.php';

class AccountModel extends ModelGeneric {

    //méthode pour ajouter un compte à la BD
    public function addAccount(Account $newAccount){
        $query = "INSERT INTO personne VALUES (NULL, :civilite, :prenom, :nom, :login, :email, 'CLIENT', now(), :tel, :mdp)";
        $this->executeRequest($query, [
            "civilite" => $newAccount->getCivilite(),
            "prenom" => $newAccount->getPrenom(),
            "nom" => $newAccount->getNom(),
            "login" => $newAccount->getLogin(),
            "email" => $newAccount->getEmail(),
            "tel" => $newAccount->getTel(),
            "mdp" => password_hash($newAccount->getMdp(), PASSWORD_DEFAULT),
        ]);
    }

    //méthode pour vérifier et se connecter avec un compte existant
    public function connectAccount(string $login, string $mdp) {
        $query = "SELECT * FROM personne WHERE login = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$login]);

        //si le login existe 
        if($statement->rowCount() !=0){
            $resultat = $statement->fetch();
            //test sur le mdp
            if(password_verify($mdp, $resultat["mdp"])){
                extract($resultat);
                $account = new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp);
                $_SESSION['user'] = serialize($account);
                return $_SESSION['user'];
            }
        }
    }
}