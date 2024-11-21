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

    //retourne tous les véhicules de la BD
    public function findAllVehicle() {
        $statement = $this->executeRequest("SELECT * FROM vehicule");
        $vehicles = [];

        while($v = $statement->fetch()){
            extract($v);
            $vehicles[] = new Vehicle($id_vehicule, $marque, $modele, $matricule, $prix_journalier, $type_vehicule, $statut_dispo, $photo);
        }
        return $vehicles;
    }

    //trouver un véhicule par son id (peut être utile plus tard)
    public function findVehicleById(int $id_vehicule) {
        $query = $this->executeRequest("SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule", [
            "id_vehicule" => $id_vehicule,
        ]);
        extract($query->fetch());

        return new Vehicle($id_vehicule, $marque, $modele, $matricule, $prix_journalier, $type_vehicule, $statut_dispo, $photo);    
    }

    //supprime un véhicule par son id de la BD
    public function deleteVehicle($id_vehicule) {
        $query = "DELETE FROM vehicule WHERE id_vehicule = :id_vehicule";
        $this->executeRequest($query, ["id_vehicule"=> $id_vehicule,]);
    }

    //modifier un véhicule existant
    public function modifyVehicle(Vehicle $vehicle) {
        $query = "UPDATE vehicule SET marque = :marque, modele = :modele, matricule = :matricule, prix_journalier = :prix_journalier, type_vehicule = :type_vehicule, statut_dispo = :statut_dispo, photo = :photo WHERE id_vehicule = :id_vehicule";
        $this->executeRequest($query, [
            "id_vehicule" => $vehicle->getIdVehicule(),
            "marque" => $vehicle->getMarque(),
            "modele" => $vehicle->getModele(),
            "matricule" => $vehicle->getMatricule(),
            "prix_journalier" => $vehicle->getPrixJournalier(),
            "type_vehicule" => $vehicle->getTypeVehicule(),
            "statut_dispo" => $vehicle->getStatutDispo(),
            "photo" => $vehicle->getPhoto(),
        ]);
    }

    //trouver tous les véhicules disponibles dans la BD
    public function findAvailableVehicle() {
        $statement = $this->executeRequest("SELECT * FROM vehicule WHERE statut_dispo = :statut_dispo", [
            "statut_dispo" => 1,
        ]);
        $vehicles = [];

        while($v = $statement->fetch()){
            extract($v);
            $vehicles[] = new Vehicle($id_vehicule, $marque, $modele, $matricule, $prix_journalier, $type_vehicule, $statut_dispo, $photo);
        }
        return $vehicles;
    }
}