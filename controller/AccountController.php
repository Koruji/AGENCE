<?php

class AccountController {

    public function actionAccount() {
        $accountModel = new AccountModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["connectAccount"])) {
                extract($_POST);
                $connection = $accountModel->connectAccount($login, $mdp);

                if ($connection != null) {
                    header("location: ?action=menu");
                    exit;
                }

            }
            else if(isset($_POST["createAccount"])) { 
                extract($_POST);
                $newAccount = new Account(0, $civilite, $prenom, $nom, $login,
                $email, "CLIENT", null, $tel, $mdp);
                
                $accountModel->addAccount($newAccount);
            }
        } else {
            if(isset($_GET["action"])) {
                $action = $_GET["action"];
                switch ($action) {
                    case "logout":
                        session_destroy();
                        header("location: .");
                        exit;
                    case "create":
                        include "vue/createAccount.php";
                        break;
                    case "menu":
                        include "vue/menuClient.php";
                        break;
                }
            }
        }
    }
}