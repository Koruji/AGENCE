<?php 

class MenuController {
    public function dashboard() {
        $modelAccount = new AccountModel();
        $modelVehicle = new VehicleModel();

        if(isset($_GET["action"])) {
            $action = $_GET["action"];

            switch ($action) {
                case "menuAdmin":
                    $nombreClients = $modelAccount->findClientAccount();
                    $nombreVehicules = $modelVehicle->findAllVehicle();
                    include "vue/menuAdmin.php";
                    break;
                case "menuClient":
                    include "vue/menuClient.php";
                    break;
            }
        
        }
    }
}