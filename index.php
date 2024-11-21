<?php 
session_start();

include "classes/Account.php";
include "classes/Vehicle.php";
include "classes/Reservation.php";
include "classes/Commentary.php";

include "controller/AccountController.php";
include "controller/VehicleController.php";
include "controller/MenuController.php";
include "controller/CommentaryController.php";
include "controller/ReservationController.php";

include "model/AccountModel.php";
include "model/VehicleModel.php";
include "model/CommentaryModel.php";
include "model/ReservationModel.php";

$compte = new AccountController();
$compte->actionAccount();
$vehicle = new VehicleController();
$vehicle->actionVehicle();
$menu = new MenuController();
$menu->dashboard();
$reservation = new ReservationController();
$reservation->actionReservation();
$commentaire = new CommentaryController();
$commentaire->actionCommentary();

if( !isset($_GET['action']) ){
    include "vue/loginPage.php";
}
