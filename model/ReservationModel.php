<?php 

class ReservationModel extends ModelGeneric {
    //ajouter une reservation à la BD
    public function addReservation(Reservation $reservation) {
        $query = "INSERT INTO reservation VALUES (NULL, :date_reservation, :date_debut, :date_fin, :id_vehicule, :id_personne)";
        $this->executeRequest($query, [
            "date_reservation" => $reservation->getDateReservation(),
            "date_fin" => $reservation->getDateFin(),
            "date_debut" => $reservation->getDateDebut(),
            "id_vehicule" => $reservation->getIdVehicule(),
            "id_personne" => $reservation->getIdPersonne(),
        ]);
    }
}