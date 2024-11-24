<?php ob_start(); ?>

<h5>Ajouter un commentaire et une note à vos réservations passées</h5>

<div class="mt-3">
    <table class="table table-striped">
            <tr>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Prix de la réservation</th>
                <th>Modèle de véhicule</th>
                <th>Matricule du véhicule</th>    
                <th>Action</th>
                <th></th>      
            </tr>
            <?php foreach($pastReservation as $reservation): ?>
                <tr>
                    <td> <?= $reservation->modifyDate($reservation->getDateDebut()) ?> </td>
                    <td> <?= $reservation->modifyDate($reservation->getDateFin()) ?> </td>
                    <td> <?= $reservation->getPrixTotal() ?> &euro;</td>
                    <td> <?php 
                        $vehiculeModel = new VehicleModel();
                        echo $vehiculeModel->findVehicleById($reservation->getIdVehicule())->getModele();
                    ?></td>
                    <td> <?php 
                        echo $vehiculeModel->findVehicleById($reservation->getIdVehicule())->getMatricule();
                    ?></td>
                    <td><a href="?action=formCommentary&id=<?=$reservation->getIdReservation()?>" class="btn btn-primary">Ajouter un commentaire</a></td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>


<?php 
$contenu = ob_get_clean();
include "vue/template.php";