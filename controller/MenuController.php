<?php 

class MenuController {
    public function dashboard() {
        $modelAccount = new AccountModel();
        $modelVehicle = new VehicleModel();
        $modelReservation = new ReservationModel();

        if(isset($_GET["action"])) {
            $action = $_GET["action"];

            switch ($action) {
                case "menuAdmin":
                    $nombreClients = $modelAccount->findClientAccount();
                    $nombreVehicules = $modelVehicle->findAllVehicle();
                    include "vue/menuAdmin.php";
                    break;
                case "menuClient":
                    $idUser = unserialize($_SESSION['user'])->getIdPersonne();
                    $reservationClient = $modelReservation->findAllActiveReservationByAccount($idUser);
                    $ancienneReservation = $modelReservation->findAllPastReservationByAccount($idUser);
                    $montantDepense = $modelAccount->findAccountById($idUser);
                    $depense = $montantDepense->getDepenses();
                    include "vue/menuClient.php";
                    break;
                case "listVehicle":
                    $vehiculeDispo = $modelVehicle->findAvailableVehicle();
                    include "vue/listVehicule.php";
                    break;
            }
        
        }
    }
}