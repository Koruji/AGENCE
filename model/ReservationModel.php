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

}