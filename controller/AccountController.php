<?php

class AccountController {

    public function actionAccount() {
        $accountModel = new AccountModel();
        if(isset($_GET["action"])) {
            $action = $_GET["action"];
            switch ($action) {
                case "logout":
                    session_destroy();
                    header("location: .");
                    exit;
            }
        }
        else if(isset($_POST["connectAccount"])) {
            extract($_POST);
            $accountModel->connectAccount($login, $mdp);
        }
        else if(isset($_POST["createAccount"])) { 
            extract($_POST);
            $newAccount = new Account(0, $civilite, $prenom, $nom, $login,
            $email, "CLIENT", null, $tel, $mdp);
            
            $accountModel->addAccount($newAccount);
        }
    }
}