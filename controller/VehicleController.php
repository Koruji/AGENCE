<?php 

class VehicleController {
    public function actionVehicle() {
        $vehicleModel = new VehicleModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["addVehicle"])) { 
                extract($_POST);
                $newVehicle = new Vehicle(0, $marque, $modele, $matricule, $prix_journalier, $type_vehicule, $statut_dispo, '');
                $vehicleModel->addVehicle($newVehicle);
                header("location: ?action=gestionVehicule");
                exit;
            }
        } else {
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case "gestionVehicule" : 
                        $vehicules = $vehicleModel->findAllVehicle();
                        include "vue/manageVehicule.php";
                        break;
                    case "ajouterVehicule" : 
                        include "vue/formVehicle.php";
                        break;
                    case "supprimerVehicule" : 
                        $id = $_GET['id'];
                        $vehicleModel->deleteVehicle($id);
                        header("location: ?action=gestionVehicule");
                        exit;
                    case "modifierVehicule" : 
                        $id = $_GET['id'];
                        $vehiculeParId = $vehicleModel->findVehicleById($id);
                        header("location: ?action=ajouterVehicule");
                        exit;
                }
            }
        }
    }
}