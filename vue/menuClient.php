<?php ob_start(); ?>

<div class="d-flex">
    <div class="w-50 bg-light rounded p-3 me-3 d-flex flex-column">
        <h5 class="text-center">
            Mes réservations
        </h5>
        <table class="table table-striped">
            <?php foreach($reservationClient as $reservation): ?>
                <tr>
                    <th><?= $reservation->getDateDebut() ?></th>
                    <th><?= $reservation->getDateFin() ?></th>
                    <th><?= $reservation->getIdVehicule() ?></th>
                    <th></th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="w-50 d-flex flex-column">
        <div class="flex-grow-1 bg-light rounded p-3 mb-3 d-flex flex-column">
            <h5 class="text-center">
                Mes évaluations
            </h5>
            <p> A compléter avec les évaluations déjà mise !</p>
        </div>

        <div class="flex-grow-2 bg-light rounded p-3 d-flex flex-column">
            <h5 class="text-center">
                Véhicules disponibles
            </h5>
            <p>
                Envie de louer un véhicule ? 
                Regardez notre sélection disponible à la location.
            </p>
            <a href="" class="btn btn-primary mt-2">OK</a>
        </div>
    </div>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";