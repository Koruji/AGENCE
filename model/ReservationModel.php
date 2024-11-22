<?php 

class ReservationModel extends ModelGeneric {
    //ajouter une reservation à la BD
    public function addReservation(Reservation $reservation) {
        $query = "INSERT INTO reservation VALUES (NULL, now(), :date_debut, :date_fin, :id_vehicule, :id_personne)";
        $this->executeRequest($query, [
            "date_fin" => $reservation->getDateFin(),
            "date_debut" => $reservation->getDateDebut(),
            "id_vehicule" => $reservation->getIdVehicule(),
            "id_personne" => $reservation->getIdPersonne(),
        ]);

        $this->addReservationPrice($reservation->getIdPersonne(), $reservation->getIdVehicule());
    }

    //pour supprimer une réservation 
    public function deleteReservation($id_personne, $id_vehicule) {
        $query = "DELETE FROM reservation WHERE id_personne = :id_personne AND id_vehicule = :id_vehicule";
        $this->executeRequest($query, [
            "id_vehicule" => $id_vehicule,
            "id_personne" => $id_personne,
        ]);

        $this->deleteReservationPrice($id_personne, $id_vehicule);
    }
    
    //pour vérifier si la plage de jour donné n'est pas déjà réservé
    public function checkReservation($idVehicule, $dateDebut, $dateFin) {
        $query = "SELECT * FROM reservation WHERE id_vehicule = :id_vehicule
                                AND (date_debut <= :date_fin AND date_fin >= :date_debut)";
        $conflit = $this->executeRequest($query, [
            "id_vehicule" => $idVehicule,
            "date_debut" => $dateDebut,
            "date_fin" => $dateFin,
        ])->rowCount() > 0;
    
        if ($conflit) {
            return "Le véhicule choisi est déjà réservé sur cette période.";
        }
        return "";
    }

    //pour récupérer toutes les réservations d'un compte client
    public function findAllReservation($idPersonne) {
        $statement = $this->executeRequest("SELECT * FROM reservation WHERE id_personne = :id_personne", [
            "id_personne" => $idPersonne,
        ]);
        $reservations = [];

        while($r = $statement->fetch()){
            extract($r);
            $reservations[] = new Reservation($id_vehicule, $id_personne, $id_reservation, $date_reservation, $date_debut, $date_fin);
        }
        return $reservations;
    }

    //pour ajouter le montant de la réservation aux dépenses du client
    public function addReservationPrice($id_personne, $id_vehicule) {
        $modelAccount = new AccountModel();
        $modelVehicule = new VehicleModel();

        $personne = $modelAccount->findAccountById($id_personne);
        $vehicule = $modelVehicule->findVehicleById($id_vehicule);

        $personne->addMontantDepense((int) $vehicule->getPrixJournalier());
        $modelAccount->updateDepenses($personne);
    }

    //pour supprimer le montant de la réservation aux dépenses du client
    public function deleteReservationPrice($id_personne, $id_vehicule) {
        $modelAccount = new AccountModel();
        $modelVehicule = new VehicleModel();

        $personne = $modelAccount->findAccountById($id_personne);
        $vehicule = $modelVehicule->findVehicleById($id_vehicule);

        $personne->deleteMontantDepense((int) $vehicule->getPrixJournalier());
        $modelAccount->updateDepenses($personne);
    }

}