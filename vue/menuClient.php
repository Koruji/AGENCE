<?php ob_start(); ?>

<h4 class="mb-3 text-center">Bonjour <?= unserialize($_SESSION['user'])->getPrenom() ?> ! <i class="bi bi-sun-fill text-warning"></i></h4>
<div class="container vh-100 d-flex">
    <div class="flex-grow-2 bg-light rounded p-3 me-3 d-flex flex-column shadow-sm">
        <h5 class="text-center">
            Mes réservations
        </h5>
        <table class="">
            <?php foreach($reservationClient as $reservation): ?>
                <tr>
                    <th><strong class="text-success"><?= $reservation->modifyDate($reservation->getDateDebut()) ?></strong>
                        au <strong class="text-danger"> <?= $reservation->modifyDate($reservation->getDateFin()) ?> </strong></th>                    
                    <th>avec <?php
                        $vehicule = new VehicleModel();
                        echo $vehicule->findVehicleById($reservation->getIdVehicule())->getModele();
                    ?></th>
                    <!-- TODO: bouton En cours si date du jour correspond à une date de la période +
                     afficher uniquement les résas en cours ou futures (pas les antérieures) -->
                    <th><a href="" class="btn btn-primary mt-2">Modifier</th>
                    <th><a href="?action=deleteResa&id=<?=$reservation->getIdReservation()?>" class="btn btn-danger mt-2 resaSuppr">Annuler</th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="flex-grow-1 d-flex flex-column">
        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm">
            <h5 class="text-center">
                Mes évaluations
            </h5>
            <p> A compléter avec les évaluations déjà mise !</p>
        </div>

        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm">
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