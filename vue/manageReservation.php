<?php ob_start(); ?>

<div>
    <a href="?action=addReservation" class="btn btn-primary mt-2">Ajouter une réservation</a>
</div>

<div class="mt-3">
    <table class="table table-striped">
            <tr>
                <th>Date de réservation</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Prix de la réservation</th>
                <th>Client</th>
                <th>Modèle de véhicule</th>
                <th>Matricule du véhicule</th>    
                <th>Action</th>
                <th></th>      
            </tr>
            <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td> <?= $reservation->modifyDate($reservation->getDateReservation()) ?> </td>
                    <td> <?= $reservation->modifyDate($reservation->getDateDebut()) ?> </td>
                    <td> <?= $reservation->modifyDate($reservation->getDateFin()) ?> </td>
                    <td> <?= $reservation->getPrixTotal() ?> &euro;</td>
                    <td> <?php 
                        $accountModel = new AccountModel();
                        echo $accountModel->findAccountById($reservation->getIdPersonne())->getNom();
                    ?></td>
                    <td> <?php 
                        $vehiculeModel = new VehicleModel();
                        echo $vehiculeModel->findVehicleById($reservation->getIdVehicule())->getModele();
                    ?></td>
                    <td> <?php 
                        echo $vehiculeModel->findVehicleById($reservation->getIdVehicule())->getMatricule();
                    ?></td>
                    <?php if($reservation->getDateDebut() > date('Y-m-d')): ?>
                        <td><a href="?action=modifyResa&id=<?=$reservation->getIdReservation()?>" class="btn btn-primary mt-2">Modifier</a></td>
                        <td><a href="?action=deleteResa&id=<?=$reservation->getIdReservation()?>" class="btn btn-danger mt-2 resaSuppr">Supprimer</td>
                    <?php else : ?>
                        <td><a class="btn btn-primary">En cours...</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
    </table>
</div>


<?php 
$contenu = ob_get_clean();
include "vue/template.php";