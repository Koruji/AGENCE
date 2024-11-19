<?php 

class Vehicle {
    private $id_vehicule;
    private	$marque;
    private $modele;
    private $matricule;
    private $prix_journalier;
    private $type_vehicule;
    private $statut_dispo;
    private $photo;

    public function __construct($p_id_vehicule, $p_marque, $p_modele, $p_matricule, $p_prix_journalier, $p_type_vehicule, $p_statut_dispo, $p_photo) {
        $this->id_vehicule = $p_id_vehicule;
        $this->marque = $p_marque;
        $this->modele = $p_modele;
        $this->matricule = $p_matricule;
        $this->prix_journalier = $p_prix_journalier;
        $this->type_vehicule = $p_type_vehicule;
        $this->statut_dispo = $p_statut_dispo;
        $this->photo = $p_photo;
    }

    //--------------------------------------------------------GETTER + SETTER
    public function getIdVehicule() {
        return $this->id_vehicule;
    }

    public function setIdVehicule($id_vehicule) {
        $this->id_vehicule = $id_vehicule;
    }

    public function getMarque() {   
        return $this->marque;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function getModele() {
        return $this->modele;
    }

    public function setModele($modele) {
        $this->modele = $modele;
    }

    public function getMatricule() {
        return $this->matricule;
    }

    public function setMatricule($matricule) {
        $this->matricule = $matricule;
    }

    public function getPrixJournalier() {
        return $this->prix_journalier;
    }

    public function setPrixJournalier($prix_journalier) {
        $this->prix_journalier = $prix_journalier;
    }

    public function getTypeVehicule() {
        return $this->type_vehicule;
    }

    public function setTypeVehicule($type_vehicule) {
        $this->type_vehicule = $type_vehicule;
    }

    public function getStatutDispo() {
        return $this->statut_dispo;
    }

    public function setStatutDispo($statut_dispo) {
        $this->statut_dispo = $statut_dispo;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}