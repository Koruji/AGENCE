<?php ob_start(); ?>
    
<?php if(!isset($_SESSION['user'])) : ?>
    <div class="bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm">
        <p>Un de nos véhicules vous plaît ? Créez un compte pour réserver dès maintenant.</p>
        <a href="?action=createAccount" class="btn btn-primary mt-2">Créer un compte</a>
    </div>
<?php endif; ?> 

<form action="" method="POST">
    <div class="input-group mb-3">
        <select class="form-select" name="vehiculeType">
            <option value="" selected>Type</option>
            <option value="2_roues">2 roues</option>
            <option value="camion">Camion</option>
            <option value="voiture">Voiture</option>
        </select>

        <select class="form-select" name="vehiculeMarque">
            <option value="" selected>Marque</option>
            <?php
                foreach ($marqueVehicule as $marque) {
                    echo "<option value=\"$marque\">$marque</option>";
                }
            ?>
        </select>

        <select class="form-select" name="vehiculeModele">
            <option value="" selected>Modèle</option>
            <?php
                foreach ($modeleVehicule as $modele) {
                    echo "<option value=\"$modele\">$modele</option>";
                }
            ?>
        </select>
        
        <input class="btn btn-outline-secondary" name="vehiculeSearchBar" type="submit" value="Rechercher">
    </div>
</form>

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
                <td> <?php if(file_exists($vehicule->getPhoto())) : ?> 
                    <img src="<?php echo $vehicule->getPhoto(); ?>" alt="Image du véhicule" width="100" height="100">
                <?php endif; ?> </td>
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