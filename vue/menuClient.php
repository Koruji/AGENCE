<?php ob_start(); ?>

<h4 class="mb-3 text-center">Bonjour <?= unserialize($_SESSION['user'])->getPrenom() ?> ! <i class="bi bi-sun-fill text-warning"></i></h4>
<div class="conteneur">
    <div class="colonneGauche">
        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm reservation">
            <h5 class="text-center">
                Mes réservations
            </h5>
            <table class="table">
                <?php foreach($reservationClient as $reservation): ?>
                    <tr>
                        <td><strong class="text-success"><?= $reservation->modifyDate($reservation->getDateDebut()) ?></strong>
                            au <strong class="text-danger"> <?= $reservation->modifyDate($reservation->getDateFin()) ?> </strong></td>                    
                        <td>avec <?php
                            $vehicule = new VehicleModel();
                            echo $vehicule->findVehicleById($reservation->getIdVehicule())->getModele();
                        ?></td>
                        <?php if($reservation->getDateDebut() > date('Y-m-d')): ?>
                            <th><a href="?action=modifyResa&id=<?=$reservation->getIdReservation()?>" class="btn btn-primary mt-2">Modifier</a></th>
                            <th><a href="?action=deleteResa&id=<?=$reservation->getIdReservation()?>" class="btn btn-danger mt-2 resaSuppr">Annuler</th>
                        <?php else : ?>
                            <th><a class="btn btn-primary">En cours...</a></th>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm reservation">
            <h5 class="text-center">
                Mes anciennes réservations
            </h5>
            <table class="table">
                <?php foreach($ancienneReservation as $reservation): ?>
                    <tr>
                        <td><strong class="text-success"><?= $reservation->modifyDate($reservation->getDateDebut()) ?></strong>
                            au <strong class="text-danger"> <?= $reservation->modifyDate($reservation->getDateFin()) ?> </strong></td>                    
                        <td>avec <?php
                            $vehicule = new VehicleModel();
                            echo $vehicule->findVehicleById($reservation->getIdVehicule())->getModele();
                        ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="colonneDroite">
        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm evaluation">
            <h5 class="text-center">
                Mes évaluations
            </h5>
            <table class="table text-center">
                <?php foreach($commentaires as $comment): ?>
                    <tr>
                        <th class="text-warning"><?php 
                            $numberStar = $comment->getNote();
                            $affichageNote = "";
                            for ($i = 0; $i < $numberStar; $i++) {
                                $affichageNote .= '<i class="bi bi-star-fill"></i>';
                            }
                            echo $affichageNote;                            
                        ?></th>
                        <th><?php 
                            $modelV = new VehicleModel();
                            $vehicule = $modelV->findVehicleById($comment->getIdVehicule());
                            $affichage = $vehicule->getModele();
                            echo $affichage;
                        ?></th>
                        <th><?php 
                            echo $comment->getCommentaire();
                        ?></th>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm reservation">
            <h5 class="text-center">
                Montant total des réservations
            </h5>
            <p class="text-center display-1 m-0">
                <strong class="text-success"> <?php echo $depense;?> &euro;
            </p>
        </div>
    </div>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";