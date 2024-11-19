<?php 

class VehicleController {
    public function actionVehicle() {
        $vehicleModel = new VehicleModel();

        if(isset($_POST["addVehicle"])) { 
            extract($_POST);
            $newVehicle = new Vehicle(0, $marque, $modele, $matricule, $prix_journalier, $type_vehicule, $statut_dispo, '');
            $vehicleModel->addVehicle($newVehicle);
        }
    }
}