<?php

class AccountController {

    public function actionAccount() {
        $accountModel = new AccountModel();

        if(isset($_POST["connectAccount"])) {
            extract($_POST);
            $accountModel->connectAccount($login, $mdp);
        }
        if(isset($_POST["createAccount"])) { 
            extract($_POST);
            $newAccount = new Account(0, $civilite, $prenom, $nom, $login,
            $email, "CLIENT", null, $tel, $mdp);
            
            $accountModel->addAccount($newAccount);
        }
    }
}