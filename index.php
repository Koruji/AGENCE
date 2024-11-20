<?php 
session_start();
include "classes/Account.php";
include "classes/Vehicle.php";

include "controller/AccountController.php";
include "controller/VehicleController.php";

include "model/AccountModel.php";
include "model/VehicleModel.php";
//include "model/ModelGeneric.php";

// include "vue/header.php";
// include "vue/login.php";
// include "vue/createAccount.php";
// include "vue/commentary.php";
//include "vue/reservation.php";

$compte = new AccountController();
$compte->actionAccount();
$vehicle = new VehicleController();
$vehicle->actionVehicle();

if( !isset($_GET['action']) ){
    include "vue/login.php";
}

// include "vue/footer.php";