<?php 
require_once 'model/ModelGeneric.php';

class AccountModel extends ModelGeneric {

    //méthode pour ajouter un compte à la BD
    public function addAccount(Account $newAccount){
        $verificationLogin = "SELECT * FROM personne WHERE login = :login";
        $erreur = $this->executeRequest($verificationLogin, [
            "login" => $newAccount->getLogin(),
        ])->rowCount() > 0;

        if ($erreur) {
            return "Login déjà utilisé.";
        } else {
            $query = "INSERT INTO personne VALUES (NULL, :civilite, :prenom, :nom, :login, :email, 'CLIENT', now(), :tel, :mdp, :depenses)";
            $this->executeRequest($query, [
                "civilite" => $newAccount->getCivilite(),
                "prenom" => $newAccount->getPrenom(),
                "nom" => $newAccount->getNom(),
                "login" => $newAccount->getLogin(),
                "email" => $newAccount->getEmail(),
                "tel" => $newAccount->getTel(),
                "mdp" => password_hash($newAccount->getMdp(), PASSWORD_DEFAULT),
                "depenses" => $newAccount->getDepenses(),
            ]);
            $lastId = $this->pdo->lastInsertId();

            //on associe directement la session au nouvel utilisateur de créé si l'admin n'est pas connecté
            if($_SESSION['user'] === null) {
                $_SESSION['user'] = serialize($this->findAccountById($lastId));
            }
            return "";
        }

        
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
                $account = new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp, $depenses);
                $_SESSION['user'] = serialize($account);

                return $_SESSION['user'];
            }
        }
    }

    //méthode pour trouver un compte par son id
    public function findAccountById(int $id){
        $query = $this->executeRequest("SELECT * FROM personne WHERE id_personne = :id", ["id" => $id]);
        extract($query->fetch());

        return new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp, $depenses);
    }

    //méthode pour trouver tous les comptes CLIENTS
    public function findClientAccount() {
        $query = $this->executeRequest("SELECT * FROM personne WHERE role = :role", [
            "role" => "CLIENT",
        ]);
        $clients = [];

        while($c = $query->fetch()){
            extract($c);
            $clients[] = new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp, $depenses);
        }
        return $clients;
    }

    //retourne tous les comptes de la BD
    public function findAllAccount() {
        $statement = $this->executeRequest("SELECT * FROM personne");
        $personnes = [];

        while($c = $statement->fetch()){
            extract($c);
            $personnes[] = new Account($id_personne, $civilite, $prenom, $nom, $login, $email, $role, $date_inscription, $tel, $mdp, $depenses);
        }
        return $personnes;
    }

    //pour supprimer un compte 
    public function deleteAccount($id_personne) {
        $query = "DELETE FROM personne WHERE id_personne = :id_personne";
        $this->executeRequest($query, ["id_personne" => $id_personne]);
    }

    //pour modifier un compte
    public function updateAccount(Account $account) {
        $query = "UPDATE personne SET civilite = :civilite, prenom = :prenom, nom = :nom, login = :login, email = :email, role = :role, date_inscription = now(), tel = :tel, mdp = :mdp, depenses = :depenses WHERE personne.id_personne = :id_personne";
        $this->executeRequest($query, [
            "id_personne" => $account->getIdPersonne(),
            "civilite" => $account->getCivilite(),
            "prenom" => $account->getPrenom(),
            "nom" => $account->getNom(),
            "login" => $account->getLogin(),
            "email" => $account->getEmail(),
            "role" => $account->getRole(),
            "tel" => $account->getTel(),
            "mdp" => $account->getMdp(),
            "depenses" => $account->getDepenses(),
        ]);
    }

    public function updateDepenses(Account $account) {
        $query = "UPDATE personne SET depenses = :depenses WHERE id_personne = :id_personne";
        $this->executeRequest($query, [
            "id_personne" => $account->getIdPersonne(),
            "depenses" => $account->getDepenses(),
        ]);
        
    }
}