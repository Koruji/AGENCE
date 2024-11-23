<?php 

class ReservationModel extends ModelGeneric {
    //ajouter une reservation à la BD
    public function addReservation(Reservation $reservation) {
        $montant = $this->calculatePrice($reservation, $reservation->getIdVehicule());
        $this->addReservationPrice($reservation, $montant);
        $reservation->setPrixTotal($montant);
        
        $query = "INSERT INTO reservation VALUES (NULL, now(), :date_debut, :date_fin, :prix_total, :id_vehicule, :id_personne)";
        $this->executeRequest($query, [
            "date_fin" => $reservation->getDateFin(),
            "date_debut" => $reservation->getDateDebut(),
            "prix_total" => $reservation->getPrixTotal(),
            "id_vehicule" => $reservation->getIdVehicule(),
            "id_personne" => $reservation->getIdPersonne(),
        ]);
        
    }

    //pour supprimer une réservation 
    public function deleteReservation(Reservation $reservation) {
        $this->deleteReservationPrice($reservation);
        $query = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
        $this->executeRequest($query, [
            "id_reservation" => $reservation->getIdReservation(),
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
    public function findAllActiveReservationByAccount($idPersonne) {
        $statement = $this->executeRequest("SELECT * FROM reservation WHERE id_personne = :id_personne AND date_fin >= now()", [
            "id_personne" => $idPersonne,
        ]);
        $reservations = [];

        while($r = $statement->fetch()){
            extract($r);
            $reservations[] = new Reservation($id_vehicule, $id_personne, $id_reservation, $date_reservation, $date_debut, $date_fin, $prix_total);
        }
        return $reservations;
    }

    //trouver une réservation par son id
    public function findReservationById($id_reservation) {
        $query = "SELECT * FROM reservation WHERE id_reservation = :id_reservation";
        $res = $this->executeRequest($query, [
            "id_reservation" => $id_reservation,
        ]); 
        extract($res->fetch());

        return new Reservation($id_vehicule, $id_personne, $id_reservation, $date_reservation, $date_debut, $date_fin, $prix_total);
    }

    //pour ajouter le montant de la réservation aux dépenses du client
    public function addReservationPrice(Reservation $reservation, $montant) {
        $modelAccount = new AccountModel();
        $personne = $modelAccount->findAccountById($reservation->getIdPersonne());

        $personne->addMontantDepense($montant);
        $modelAccount->updateDepenses($personne);
    }

    //pour supprimer le montant de la réservation aux dépenses du client
    public function deleteReservationPrice(Reservation $reservation) {
        $modelAccount = new AccountModel();

        $personne = $modelAccount->findAccountById($reservation->getIdPersonne());

        $personne->deleteMontantDepense($reservation->getPrixTotal());
        $modelAccount->updateDepenses($personne);
    }

    //calcul montant total de la résa 
    public function calculatePrice(Reservation $reservation, $id_vehicule) {
        $modelVehicule = new VehicleModel();
        $facteur = (int) $reservation->getNumberOfDay();
        $prixJournalier = (int) $modelVehicule->findVehicleById($id_vehicule)->getPrixJournalier();
        
        return $facteur * $prixJournalier;
    }

    //trouver toutes les réservations du site
    public function findAllReservationActive() {
        $statement = $this->executeRequest("SELECT * FROM reservation WHERE date_fin >= now()");
        $reservation = [];

        while($r = $statement->fetch()){
            extract($r);
            $reservation[] = new Reservation($id_vehicule, $id_personne, $id_reservation, $date_reservation, $date_debut, $date_fin, $prix_total);
        }
        return $reservation;
    }

    //mettre à jour une réservation 
    public function updateReservation(Reservation $reservation) {

        $nouveauMontant = $this->calculatePrice($reservation, $reservation->getIdVehicule());
        $reservation->setPrixTotal($nouveauMontant);

        $query = "UPDATE reservation SET date_reservation = now(), date_debut = :date_debut, date_fin = :date_fin, prix_total = :prix_total, id_vehicule = :id_vehicule, id_personne = :id_personne WHERE reservation.id_reservation = :id_reservation";
        $this->executeRequest($query, [
            "id_reservation" => $reservation->getIdReservation(),
            "date_debut" => $reservation->getDateDebut(),
            "date_fin" => $reservation->getDateFin(),
            "prix_total" => $reservation->getPrixTotal(),
            "id_vehicule" => $reservation->getIdVehicule(),
            "id_personne" => $reservation->getIdPersonne(),
        ]);
        $this->addReservationPrice($reservation, $nouveauMontant);
    }

    //pour récupérer les réservations passées 
    public function findAllPastReservation() {
        $statement = $this->executeRequest("SELECT * FROM reservation WHERE date_fin < now()");
        $reservation = [];

        while($r = $statement->fetch()){
            extract($r);
            $reservation[] = new Reservation($id_vehicule, $id_personne, $id_reservation, $date_reservation, $date_debut, $date_fin, $prix_total);
        }
        return $reservation;
    }

}