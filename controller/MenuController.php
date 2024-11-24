<?php 

class MenuController {
    public function dashboard() {
        $modelAccount = new AccountModel();
        $modelVehicle = new VehicleModel();
        $modelReservation = new ReservationModel();
        $modelCommentary = new CommentaryModel();

        if(isset($_GET["action"])) {
            $action = $_GET["action"];

            switch ($action) {
                case "menuAdmin":
                    $nombreClients = $modelAccount->findClientAccount();
                    $nombreVehicules = $modelVehicle->findAllVehicle();
                    $commentaires = $modelCommentary->findAllComment();
                    include "vue/menuAdmin.php";
                    break;
                case "menuClient":
                    $idUser = unserialize($_SESSION['user'])->getIdPersonne();
                    $reservationClient = $modelReservation->findAllActiveReservationByAccount($idUser);
                    $ancienneReservation = $modelReservation->findAllPastReservationByAccount($idUser);
                    $commentaires = $modelCommentary->findAllCommentByAccount($idUser);
                    $montantDepense = $modelAccount->findAccountById($idUser);
                    $depense = $montantDepense->getDepenses();
                    include "vue/menuClient.php";
                    break;
                case "listVehicle":
                    $marqueVehicule = $modelVehicle->findAllVehicleMarque();
                    $modeleVehicule = $modelVehicle->findAllVehicleModele();

                    if (isset($_POST['vehiculeSearchBar'])) {
                        // Récupérer les critères de recherche
                        $type = !empty($_POST['vehiculeType']) ? $_POST['vehiculeType'] : null;
                        $marque = !empty($_POST['vehiculeMarque']) ? $_POST['vehiculeMarque'] : null;
                        $modele = !empty($_POST['vehiculeModele']) ? $_POST['vehiculeModele'] : null;
                    
                        // Traiter la recherche et obtenir les résultats
                        $vehiculeDispo = $modelVehicle->findVehiculeBySearch($type, $marque, $modele);
                    } else {
                        // Si aucune recherche, on affiche tous les véhicules disponibles
                        $vehiculeDispo = $modelVehicle->findAvailableVehicle();
                    }

                    include "vue/listVehicule.php";
                    break;  
                case "menuCommentary":
                    $idUser = unserialize($_SESSION['user'])->getIdPersonne();
                    $pastReservation = $modelReservation->findAllPastReservationByAccount($idUser);
                    include "vue/menuCommentary.php";
                    break;
            }
        
        }
    }
}