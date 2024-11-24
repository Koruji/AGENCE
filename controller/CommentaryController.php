<?php 

class CommentaryController {
    public function actionCommentary() {
        $commentaryModel = new CommentaryModel();
        $reservationModel = new ReservationModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['postComment'])) {
                $reservation = $reservationModel->findReservationById($_POST["idReservation"]);
                extract($_POST);
                $newCommentary = new Commentary($reservation->getIdVehicule(), $reservation->getIdPersonne(), $reservation->getIdReservation(), 0, $commentaire, null, $note);
                $commentaryModel->addCommentary($newCommentary);
                header("location: ?action=menuCommentary");
                exit;
            }
        } else {
            if(isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case 'formCommentary':
                        $id = $_GET["id"];
                        $selectReservation = $reservationModel->findReservationById($id);
                        include "vue/formCommentary.php";
                        break;
                }
            }
        }
    }
}