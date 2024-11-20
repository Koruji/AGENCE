<?php 

class VehicleController {
    public function actionVehicle() {
        $vehicleModel = new VehicleModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["addVehicle"])) { 
                extract($_POST);
                $newVehicle = new Vehicle(0, $marque, $modele, $matricule, $prix_journalier, $type_vehicule, $statut_dispo, '');
                $vehicleModel->addVehicle($newVehicle);
            }
        } else {
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case "gestionVehicule" : 
                        include "vue/menuVehicule.php";
                        break;
                    case "ajouterVehicule" : 
                        include "vue/createVehicle.php";
                        break;
                }
            }
        }
    }
}