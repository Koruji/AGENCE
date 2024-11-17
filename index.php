<?php 
session_start();
include "classes/Account.php";

include "controller/AccountController.php";

include "model/AccountModel.php";
//include "model/ModelGeneric.php";

// include "vue/header.php";
// include "vue/login.php";
// include "vue/createAccount.php";
// include "vue/commentary.php";
//include "vue/reservation.php";

$compte = new AccountController();
$compte->actionAccount();

if( !isset($_GET['action']) ){
    include "vue/login.php";
}

// include "vue/footer.php";