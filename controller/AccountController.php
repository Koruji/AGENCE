<?php

class AccountController {

    public function createAccount() {
        $accountModel = new AccountModel();

        if(isset($_POST["createAccount"])) { 
            extract($_POST);
            $newAccount = new Account(0, $civilite, $prenom, $nom, $login,
            $email, "CLIENT", null, $tel, $mdp);
            
            $accountModel->addAccount($newAccount);
        }
    }
}