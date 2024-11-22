<?php ob_start(); ?>
    
<?php if(!isset($_SESSION['user'])) : ?>
    <div>
        <p>Un de nos véhicules vous plaît ? Créez un compte pour réserver dès maintenant.</p>
        <a href="?action=createAccount" class="btn btn-primary mt-2">Créer un compte</a>
    </div>
<?php endif; ?> 

<div>
    <a href="" class="btn btn-primary mt-2">Rechercher un véhicule</a>
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
                <td> <?= $vehicule->getPrixJournalier() ?> &euro; </td>
                <td> <?= $vehicule->getTypeVehicule() ?> </td>
                <td>Disponible</td>

                <?php if(isset($_SESSION['user'])) : ?>
                <td>
                    <a href="?action=reservation&idVehicle=<?= $vehicule->getIdVehicule()?>&idPersonne=<?= unserialize($_SESSION['user'])->getIdPersonne()?>">Réserver</a>
                </td>
                <?php endif; ?>
                
            </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";