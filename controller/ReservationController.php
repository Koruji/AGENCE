<?php 

class ReservationController {

    public function actionReservation() {
        $reservationModel = new ReservationModel();
        $idPersonne = "";
        $idVehicule = "";

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['addReservation'])) { 
                extract($_POST);
                $retourConflit = $reservationModel->checkReservation(unserialize($_SESSION['idVehicule']), $date_debut, $date_fin);
                if($retourConflit === "") {
                    $newReservation = new Reservation(unserialize($_SESSION['idVehicule']), unserialize($_SESSION['idPersonne']), 0, null, $date_debut, $date_fin);
                    $reservationModel->addReservation($newReservation);
                    header("location: ?action=listVehicle");
                    exit;
                } else {
                    header("location: ?action=reservation&message=" . $retourConflit);
                    exit;
                }     
            }
        } else {
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
                switch( $action ) {
                    case "reservation":
                        if(isset($_GET['message'])) {
                            $erreur = $_GET['message'];
                        };
                        if(isset($_GET['idPersonne']) || isset($_GET['idVehicle'])) {
                            $idPersonne = $_GET['idPersonne'];
                            $idVehicule = $_GET['idVehicle'];
                            $_SESSION['idPersonne'] = serialize($idPersonne);
                            $_SESSION['idVehicule'] = serialize($idVehicule);   
                        }        
                        include "vue/formReservation.php";
                        break;
                }
            } 
        }
    }
}