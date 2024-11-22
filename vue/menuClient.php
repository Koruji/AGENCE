<?php ob_start(); ?>

<h4 class="mb-3 text-center">Bonjour <?= unserialize($_SESSION['user'])->getPrenom() ?> ! <i class="bi bi-sun-fill text-warning"></i></h4>
<div class="container vh-100 d-flex">
    <div class="w-50 bg-light rounded p-3 me-3 d-flex flex-column shadow-sm">
        <h5 class="text-center">
            Mes réservations
        </h5>
        <table class="">
            <?php foreach($reservationClient as $reservation): ?>
                <tr>
                    <th>Du <?= $reservation->modifyDate($reservation->getDateDebut())  ?></th>
                    <th>au <?= $reservation->modifyDate($reservation->getDateFin()) ?></th>                    
                    <th>avec <?= $reservation->getIdVehicule() ?></th>
                    <th>Supprimer</th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="w-50 d-flex flex-column">
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
            <p>
                Implémenter les dépenses clients sur le site.
            </p>
        </div>
    </div>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";