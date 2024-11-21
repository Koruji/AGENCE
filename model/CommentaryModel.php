<?php 
require_once 'model/ModelGeneric.php';

class CommentaryModel extends ModelGeneric {

    //ajouter un commentaire à la BD
    public function addCommentary(Commentary $commentary) {
        $query = "INSERT INTO commentaire VALUES (NULL, :commentaire, :dateCommentaire, :note, :id_vehicule, :id_personne)";
        $this->executeRequest($query, [
            "commentaire" => $commentary->getIdCommentaire(),
            "dateCommentaire" => $commentary->getDateCommentaire(),
            "note" => $commentary->getNote(),
            "id_vehicule" => $commentary->getIdVehicule(),
            "id_personne" => $commentary->getIdPersonne(),
        ]);
    }
}