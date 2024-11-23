<?php ob_start(); ?>

<div class="d-flex justify-content-center">
    <h5>Réservations</h5>
</div>

<h6 class="text-danger" id="messageErreur"><?php if(isset($erreur)) { echo '<i class="bi bi-exclamation-triangle-fill"></i> ' . htmlspecialchars($erreur); }?></h6>

<form action="" method="POST" class="p-4 bg-light rounded shadow-sm">
    <input type="hidden" name="idPersonne" value="<?= htmlspecialchars($idPersonne); ?>">
    <input type="hidden" name="idVehicule" value="<?= htmlspecialchars($idVehicule); ?>">

    <div class="form-group">
        <label for="date_debut">Date de Début :</label>
        <input type="date" id="date_debut" name="date_debut" class="form-control" value="<?php if(isset($resa)) { echo $resa->getDateDebut();} ?>" required>
    </div>

    <div class="form-group">
        <label for="date_fin">Date de Fin :</label>
        <input type="date" id="date_fin" name="date_fin" class="form-control" value="<?php if(isset($resa)) { echo $resa->getDateFin();} ?>" required>
    </div>

    <?php if(unserialize($_SESSION['user'])->getRole() === "CLIENT"): ?>
        <?php if(!isset($resa)) : ?>
        <div class="mt-3">
            <p>Prix total : <strong class="text-success"> <?php echo $dataVehicule->getPrixJournalier() . "/ jour"; ?> &euro; </strong></p> 
        </div>

        <div class="mt-3">
            <p>Véhicule choisi : <strong class="text-info-emphasis"> <?php if(isset($dataVehicule))  { echo $dataVehicule->getModele() . " (" . $dataVehicule->getTypeVehicule() . ")"; }?> </strong></p>
        </div> <?php endif; ?>
    <?php endif; ?>

    <?php if(unserialize($_SESSION['user'])->getRole() === "ADMIN"):?>
        <div class="form-group mt-3">
            <label for="id_vehicule">Véhicule :</label>
            <select name="id_vehicule" id="id_vehicule" required>
                <?php
                foreach ($listVehicules as $vehicule) {
                    $label = $vehicule->getMarque() . " " . $vehicule->getModele() . " (Matricule :" . $vehicule->getMatricule() . ")";
                    $value = $vehicule->getIdVehicule();
                    if(isset($resa)) { $selected = ($value == $resa->getIdVehicule()) ? 'selected' : ''; }
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group mt-3 mb-3">
            <label for="id_personne">Client :</label>
            <select name="id_personne" id="id_personne" required>
                <?php
                foreach ($listClients as $client) {
                    $label = $client->getNom() . " " . $client->getPrenom();
                    $value = $client->getIdPersonne();
                    if(isset($resa)) { $selected = ($value == $resa->getIdPersonne()) ? 'selected' : ''; }
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
        </div>
    <?php endif; ?>

    <input id="addReservation" name="<?php if(unserialize($_SESSION['user'])->getRole() === "CLIENT" && !isset($resa)) {echo "addReservation";} else if(isset($resa)) { echo "modifierReservation"; } else {echo "addReservationAdmin";} ?>" type="submit" class="btn btn-primary mt-2" value="Enregistrer">
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";