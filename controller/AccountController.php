<?php

class AccountController {

    public function actionAccount() {
        $accountModel = new AccountModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["connectAccount"])) {
                extract($_POST);
                $connection = $accountModel->connectAccount($login, $mdp);

                if ($connection != null) {
                    if(unserialize($_SESSION['user'])->getRole() === "ADMIN") {
                        header("location: ?action=menuAdmin");
                        exit;
                    } else {
                        header("location: ?action=menuClient");
                        exit;
                    }
                    
                }

            }
            else if(isset($_POST["createAccount"])) { 
                extract($_POST);

                if($_SESSION['user'] === null) {
                    $newAccount = new Account(0, $civilite, $prenom, $nom, $login,
                $email, "CLIENT", null, $tel, $mdp);
                
                    $retourConflit = $accountModel->addAccount($newAccount);
                    if($retourConflit === "") {
                        header("location: ?action=menuClient");
                        exit;
                    } else {
                        header("location: ?action=createAccount&message=" . $retourConflit);
                        exit;
                    }      
                }
                else {
                    $newAccount = new Account(0, $civilite, $prenom, $nom, $login,
                $email, "CLIENT", null, $tel, $mdp);
                
                    $accountModel->addAccount($newAccount);
                    header("location: ?action=gestionClients");
                    exit;
                }
            }
            else if(isset($_POST["modifyAccount"])) {
                extract($_POST);
                $modifyAccount = new Account();
            
                $compteSauv = unserialize($_SESSION['compteSauv']);

                $modifyAccount->setIdPersonne($compteSauv->getIdPersonne());
                var_dump($compteSauv->getIdPersonne()); ////
                $modifyAccount->setCivilite($civilite);
                $modifyAccount->setPrenom($prenom);
                $modifyAccount->setLogin($login);
                $modifyAccount->setNom($nom);
                $modifyAccount->setEmail($email);
                $modifyAccount->setRole($role);
                $modifyAccount->setDateInscription(null);
                $modifyAccount->setTel($tel);
                $modifyAccount->setMdp($compteSauv->getMdp());

                $accountModel->updateAccount($modifyAccount);

                $_SESSION['compteSauv'] = null;
                header("location: ?action=gestionClients");
                exit;
            }
        } else {
            if(isset($_GET["action"])) {
                $action = $_GET["action"];
                switch ($action) {
                    case "logout":
                        session_destroy();
                        header("location: .");
                        exit;
                    case "createAccount":
                        if(isset($_GET['message'])) {
                            $messageErreurLogin = $_GET['message'];
                        }  
                        include "vue/formAccount.php";
                        break;
                    case "gestionClients": 
                        $accounts = $accountModel->findAllAccount();
                        include "vue/manageAccount.php";
                        break; 
                    case "modifierCompte": 
                        $id = $_GET['id'];
                        $compte = $accountModel->findAccountById($id);
                        $_SESSION['compteSauv'] = serialize($compte);
                        include "vue/formAccount.php";
                        break;
                    case "supprimerCompte":
                        $id = $_GET['id'];
                        $accountModel->deleteAccount($id);
                        header("location: ?action=gestionClients");
                        exit;    
                }
            }
        }
    }
}