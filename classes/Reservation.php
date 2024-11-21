<?php 

class Reservation {
    private $id_reservation;
    private $date_reservation;
    private $date_debut;
    private $date_fin;
    private $id_vehicule;
    private $id_personne;

    public function __construct(Vehicle $id_vehicule, Account $id_personne, $id_reservation = '', $date_reservation = '', $date_debut = '', $date_fin = '') {
        $this->id_reservation = $id_reservation;
        $this->date_reservation = $date_reservation;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->id_vehicule = $id_vehicule->getIdVehicule();
        $this->id_personne = $id_personne->getIdPersonne();
    }

    //-----------------------------------------GETTER ET SETTER
    public function getIdReservation() {
        return $this->id_reservation;
    }

    public function getDateReservation() {
        return $this->date_reservation;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    public function getIdVehicule() {
        return $this->id_vehicule;
    }

    public function getIdPersonne() {
        return $this->id_personne;
    }

    public function setIdReservation($id_reservation) {
        $this->id_reservation = $id_reservation;
    }

    public function setDateReservation($date_reservation) {
        $this->date_reservation = $date_reservation;
    }

    public function setDateDebut($date_debut) {
        $this->date_debut = $date_debut;
    }

    public function setDateFin($date_fin) {
        $this->date_fin = $date_fin;
    }

    public function setIdVehicule($id_vehicule) {
        $this->id_vehicule = $id_vehicule;
    }

    public function setIdPersonne($id_personne) {
        $this->id_personne = $id_personne;
    }


}