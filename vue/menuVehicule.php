<?php ob_start(); ?>

<div>
    <a href="?action=ajouterVehicule" class="btn btn-primary mt-2">Ajouter un véhicule</a>
</div>

<div class="mt-3">
    <table class="table table-striped">
            <tr>
                <th>Visuel</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Matricule</th>
                <th>Prix journalier</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?php foreach($vehicules as $vehicule): ?>
                <tr>
                    <td> <?= $vehicule->getPhoto() ?> </td>
                    <td> <?= $vehicule->getMarque() ?> </td>
                    <td> <?= $vehicule->getModele() ?> </td>
                    <td> <?= $vehicule->getMatricule() ?> </td>
                    <td> <?= $vehicule->getPrixJournalier() ?> </td>
                    <td> <?= $vehicule->getTypeVehicule() ?> </td>
                    <td> 
                        <?php 
                            if($vehicule->getStatutDispo() === 1) {
                                echo "Disponible";
                            } else {
                                echo "Réservé";
                            }
                        ?> 
                    </td>
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