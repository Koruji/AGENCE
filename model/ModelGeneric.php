<?php

abstract class ModelGeneric {
    protected $pdo;

    //connexion à la BD
    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=agence", "root", "", [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    //méthode pour éxecuter les requêtes sur la BD 
    public function executeRequest(string $query, $data = []){
        $statement = $this->pdo->prepare($query);

        foreach($data as $cle => $valeur){
            $data[$cle] = htmlentities($valeur);
        }
        $statement->execute($data);

        return $statement;
    }
}