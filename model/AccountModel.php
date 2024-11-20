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
        $lastId = $this->pdo->lastInsertId();

        //on associe directement la session au nouvel utilisateur de créé
        $_SESSION['user'] = serialize($this->findAccountById($lastId));

        header("location: ?action=menuClient");
        exit;
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

    //méthode pour trouver un compte par son id
    public function findAccountById(int $id){
        $query = $this->executeRequest("SELECT * FROM personne WHERE id_personne = :id", ["id" => $id]);
        extract($query->fetch());

        return new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp);
    }

    //méthode pour trouver tous les comptes CLIENTS
    public function findClientAccount() {
        $query = $this->executeRequest("SELECT * FROM personne WHERE role = :role", [
            "role" => "CLIENT",
        ]);
        $clients = [];

        while($c = $query->fetch()){
            extract($c);
            $clients[] = new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp);
        }
        return $clients;
    }

    //retourne tous les comptes de la BD
    public function findAllAccount() {
        $statement = $this->executeRequest("SELECT * FROM personne");
        $personnes = [];

        while($c = $statement->fetch()){
            extract($c);
            $personnes[] = new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp);
        }
        return $personnes;
    }
}