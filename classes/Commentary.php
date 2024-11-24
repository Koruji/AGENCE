<?php 

class Commentary {
    private $id_commentaire;
    private $commentaire;
    private $dateCommentaire;
    private $note;
    private $id_reservation;
    private $id_vehicule;
    private $id_personne;

    public function __construct($id_vehicule, $id_personne, $id_reservation, $id_commentaire = '', $commentaire = '', $dateCommentaire = '', $note = '') {
        $this->id_commentaire = $id_commentaire;
        $this->commentaire = $commentaire;
        $this->dateCommentaire = $dateCommentaire;
        $this->note = $note;
        $this->id_reservation = $id_reservation;
        $this->id_vehicule = $id_vehicule;
        $this->id_personne = $id_personne;
    }

    //---------------------------------GETTER ET SETTER 
    public function getIdCommentaire() {
        return $this->id_commentaire;
    }

    public function getCommentaire() {
        return $this->commentaire;
    }

    public function getDateCommentaire() {
        return $this->dateCommentaire;
    }
    public function getNote() {
        return $this->note;
    }

    public function getIdVehicule() {
        return $this->id_vehicule;
    }

    public function getIdPersonne() {
        return $this->id_personne;
    }

    public function setIdCommentaire($id_commentaire) {
        $this->id_commentaire = $id_commentaire;
    }

    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }

    public function setDateCommentaire($dateCommentaire) {
        $this->dateCommentaire = $dateCommentaire;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setIdvehicule($id_vehicule) {
        $this->id_vehicule = $id_vehicule;
    }

    public function setIdPersonne($id_personne) {
        $this->id_personne = $id_personne;
    }

    public function getIdReservation() {
        return $this->id_reservation;
    }

    public function setIdReservation($id_reservation) {
        $this->id_reservation = $id_reservation;
    }
    
}