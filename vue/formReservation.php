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
        <input type="date" id="date_debut" name="date_debut" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="date_fin">Date de Fin :</label>
        <input type="date" id="date_fin" name="date_fin" class="form-control" required>
    </div>

    <!--
    <div class="form-group">
        <label for="id_vehicule">ID Véhicule :</label>
        <input type="number" id="id_vehicule" name="id_vehicule" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="id_personne">ID Personne :</label>
        <input type="number" id="id_personne" name="id_personne" class="form-control" required>
    </div>
    -->
    <input id="addReservation" name="addReservation" type="submit" class="btn btn-primary mt-2" value="Enregistrer">
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";