<?php 
session_start();

include "classes/Account.php";
include "classes/Vehicle.php";

include "controller/AccountController.php";
include "controller/VehicleController.php";
include "controller/MenuController.php";

include "model/AccountModel.php";
include "model/VehicleModel.php";

$compte = new AccountController();
$compte->actionAccount();
$vehicle = new VehicleController();
$vehicle->actionVehicle();
$menu = new MenuController();
$menu->dashboard();

if( !isset($_GET['action']) ){
    include "vue/loginPage.php";
}
