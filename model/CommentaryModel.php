<?php 
require_once 'model/ModelGeneric.php';

class CommentaryModel extends ModelGeneric {

    //ajouter un commentaire à la BD
    public function addCommentary(Commentary $commentary) {
        $query = "INSERT INTO commentaire VALUES (NULL, :commentaire, now(), :note, :id_reservation, :id_vehicule, :id_personne)";
        $this->executeRequest($query, [
            "id_reservation" => $commentary->getIdReservation(),
            "commentaire" => $commentary->getCommentaire(),
            "note" => $commentary->getNote(),
            "id_vehicule" => $commentary->getIdVehicule(),
            "id_personne" => $commentary->getIdPersonne(),
        ]);
    }

    public function findAllCommentByAccount($id_personne) {
        $query = $this->executeRequest("SELECT * FROM commentaire WHERE id_personne = :id_personne", [
            "id_personne" => $id_personne,
        ]);
        $commentaires = [];

        while($c = $query->fetch()){
            extract($c);
            $commentaires[] = new Commentary($id_vehicule, $id_personne, $id_reservation, $id_commentaire , $commentaire, $dateCommentaire, $note);
        }
        return $commentaires;
    }

    public function findAllComment() {
        $query = $this->executeRequest("SELECT * FROM commentaire");
        $commentaires = [];

        while($c = $query->fetch()){
            extract($c);
            $commentaires[] = new Commentary($id_vehicule, $id_personne, $id_reservation, $id_commentaire , $commentaire, $dateCommentaire, $note);
        }
        return $commentaires;
    }
}