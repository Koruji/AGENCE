<?php ob_start(); ?>

<div>
    <a href="?action=ajouterVehicule" class="btn btn-primary mt-2">Rechercher un véhicule</a>
    <p>barre de recherche</p>
</div>

<div class="mt-3">
    <table class="table table-striped">
        <tr>
            <th>Visuel</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Prix journalier</th>
            <th>Type</th>
            <th>Statut</th>
            <th></th>
        </tr>
        <?php foreach($vehiculeDispo as $vehicule): ?>
            <tr>
                <td> <?= $vehicule->getPhoto() ?> </td>
                <td> <?= $vehicule->getMarque() ?> </td>
                <td> <?= $vehicule->getModele() ?> </td>
                <td> <?= $vehicule->getPrixJournalier() ?> </td>
                <td> <?= $vehicule->getTypeVehicule() ?> </td>
                <td>Disponible</td>
                <td>
                    <a href="?action=reservation&idVehicle=<?= $vehicule->getIdVehicule()?>&idPersonne=<?= unserialize($_SESSION['user'])->getIdPersonne()?>">Réserver</a>
                </td>
                
            </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";