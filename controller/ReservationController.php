<?php 

class ReservationController {

    public function actionReservation() {
        $reservationModel = new ReservationModel();
        $clientModel = new AccountModel();
        $vehiculeModel = new VehicleModel();

        $idPersonne = "";
        $idVehicule = ""; 

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['addReservation'])) { 
                extract($_POST);
                $idPersonne = unserialize($_SESSION['idPersonne']);
                $idVehicule = unserialize($_SESSION['idVehicule']);
                
                $retourConflit = $reservationModel->checkReservation($idVehicule, $date_debut, $date_fin);
                if($retourConflit === "") {
                    $newReservation = new Reservation($idVehicule, $idPersonne, 0, null, $date_debut, $date_fin, 0);
                    $reservationModel->addReservation($newReservation);
                    header("location: ?action=listVehicle");
                    exit;
                } else {
                    header("location: ?action=reservation&message=" . $retourConflit);
                    exit;
                }     
            }
            if(isset($_POST["addReservationAdmin"])) {
                $id_personne = $_POST["id_personne"];
                $id_vehicule = $_POST["id_vehicule"];
                extract($_POST);

                $retourConflit = $reservationModel->checkReservation($id_vehicule, $date_debut, $date_fin);
                if($retourConflit === "") {
                    $newReservation = new Reservation($id_vehicule, $id_personne, 0, null, $date_debut, $date_fin, 0);
                    $reservationModel->addReservation($newReservation);
                    header("location: ?action=gestionReservation");
                    exit;
                } else {
                    header("location: ?action=reservation&message=" . $retourConflit);
                    exit;
                }   
            }

            if(isset($_POST["modifierReservation"])) {
                extract($_POST);
                $resaSauv = unserialize($_SESSION['reservationSauv']);
                $reservationModel->deleteReservationPrice($resaSauv);
                if(unserialize($_SESSION['user'])->getRole() === "ADMIN") {
                    $modifyResa = new Reservation($id_vehicule, $id_personne);
                } else {
                    $modifyResa = new Reservation($resaSauv->getIdVehicule(), unserialize($_SESSION['user'])->getIdPersonne());
                }
                

                $modifyResa->setIdReservation($resaSauv->getIdReservation());
                $modifyResa->setDateReservation(null);
                $modifyResa->setDateDebut($date_debut);
                $modifyResa->setDateFin($date_fin);
                $modifyResa->setPrixTotal($resaSauv->getPrixTotal());

                $reservationModel->updateReservation($modifyResa);

                $_SESSION['reservationSauv'] = null;
                if(unserialize($_SESSION['user'])->getRole() === "ADMIN") {
                    header("location: ?action=gestionReservation");
                    exit;
                } else {
                    header("location: ?action=menuClient");
                    exit;   
                }
            }
        } else {
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
                switch( $action ) {
                    case "reservation":
                        if(unserialize($_SESSION['user'])->getRole() === "CLIENT") {
                        
                            if(isset($_GET['idPersonne']) || isset($_GET['idVehicle'])) {
                                $idPersonne = $_GET['idPersonne'];
                                $idVehicule = $_GET['idVehicle'];
                                $_SESSION['idPersonne'] = serialize($idPersonne);
                                $_SESSION['idVehicule'] = serialize($idVehicule);   
                            }
                            $vehicule = new VehicleModel();
                            $dataVehicule = $vehicule->findVehicleById( unserialize($_SESSION['idVehicule']) );   
                        }  
                        if(isset($_GET['message'])) {
                            $erreur = $_GET['message'];
                        } 
                        $listClients = $clientModel->findClientAccount();
                        $listVehicules = $vehiculeModel->findAllVehicle();                       
                        include "vue/formReservation.php";
                        break;

                    case "deleteResa":
                        $id = $_GET['id'];
                        $reservationModel->deleteReservation($reservationModel->findReservationById($id));
                        
                        if(unserialize($_SESSION['user'])->getRole() === "ADMIN") {
                            header("location: ?action=gestionReservation");
                            exit;
                        } else {
                            header("location: ?action=menuClient");
                            exit;
                        }

                    case "gestionReservation": 
                        $reservations = $reservationModel->findAllReservationActive();
                        include "vue/manageReservation.php";
                        break;
                    
                    case "addReservation":
                        header("location: ?action=reservation");
                        exit;

                    case "modifyResa":
                        $id = $_GET["id"];
                        $resa = $reservationModel->findReservationById($id);
                        $listClients = $clientModel->findClientAccount();
                        $listVehicules = $vehiculeModel->findAllVehicle();
                        $_SESSION['reservationSauv'] = serialize($resa);
                        include "vue/formReservation.php";
                        break;

                }
            } 
        }
    }
}