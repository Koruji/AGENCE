<?php

class Account {
    private $id_personne;
    private $civilite;
    private $prenom;
    private $nom;
    private $login;
    private $email;
    private $role;
    private $date_inscription;
    private $tel;
    private $mdp;

    public function __construct($p_id_personne, $p_civilite, $p_prenom, $p_nom, $p_login, $p_email, $p_role, 
        $p_date_inscription, $p_tel, $p_mdp) 
    {
            $this->id_personne = $p_id_personne;
            $this->civilite = $p_civilite;
            $this->prenom = $p_prenom;
            $this->nom = $p_nom;
            $this->login = $p_login;
            $this->email = $p_email;
            $this->role = $p_role;
            $this->date_inscription = $p_date_inscription;
            $this->tel = $p_tel;
            $this->mdp = $p_mdp;
    }

    //--------------------------------------------------------GETTER
    public function getIdPersonne(){
        return $this->id_personne;
    }

    public function getCivilite(){
        return $this->civilite;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRole(){
        return $this->role;
    }

    public function getDateInscription(){
        return $this->date_inscription;
    }

    public function gettel(){
        return $this->tel;
    }

    public function getMdp(){
        return $this->mdp;
    }

    //------------------------------------------------------------SETTER
    public function setIdPersonne($id_personne){
        $this->id_personne = $id_personne;
    }

    public function setCivilite($civilite){
        $this->civilite = $civilite;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function setDateInscription($date_inscription){
        $this->date_inscription = $date_inscription;
    }

    public function setTel($tel){
        $this->tel = $tel;
    }

    public function setMdp($mdp){
        $this->mdp = $mdp;
    }

}