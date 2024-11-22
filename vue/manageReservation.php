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
            </tr>
            <?php foreach($reservations as $reservation): ?>
                <tr>
                    <!-- TODO: système qui empèche de supprimer la réservation lorsqu'elle est démarré 
                     + afficher uniquement les résa en cours ou en attente effective (pas les antérieures) -->
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
                    <td>
                        <a href="" class="btn btn-primary mt-2">Modifier</a>
                        <a href="" class="btn btn-primary mt-2">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>


<?php 
$contenu = ob_get_clean();
include "vue/template.php";