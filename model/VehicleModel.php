<?php 
require_once 'model/ModelGeneric.php';

class VehicleModel extends ModelGeneric {
    //méthode pour ajouter un véhicule
    public function addVehicle(Vehicle $vehicle) {
        $query = "INSERT INTO vehicule VALUES (NULL, :marque, :modele, :matricule, :prix_journalier, :type_vehicule, :statut_dispo, '')";
        $this->executeRequest($query, [
            "marque" => $vehicle->getMarque(),
            "modele" => $vehicle->getModele(),
            "matricule" => $vehicle->getMatricule(),
            "prix_journalier" => $vehicle->getPrixJournalier(),
            "type_vehicule" => $vehicle->getTypeVehicule(),
            "statut_dispo" => $vehicle->getStatutDispo(),
        ]);
    }
}