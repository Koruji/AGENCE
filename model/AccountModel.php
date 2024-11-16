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
}