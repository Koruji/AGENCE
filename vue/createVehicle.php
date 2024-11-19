<?php ob_start(); ?>

<h6 id="messageErreur"></h6>

<form action="" id="vehicle_form" method="POST" enctype="multipart/form-data" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="marque">Marque :</label>
        <input type="text" id="marque" name="marque" class="form-control" maxlength="25">
    </div>

    <div class="form-group">
        <label for="modele">Modèle :</label>
        <input type="text" id="modele" name="modele" class="form-control" maxlength="25">
    </div>

    <div class="form-group">
        <label for="matricule">Matricule :</label>
        <input type="text" id="matricule" name="matricule" class="form-control" maxlength="25">
    </div>

    <div class="form-group">
        <label for="prix_journalier">Prix Journalier :</label>
        <input type="number" id="prix_journalier" name="prix_journalier" class="form-control">
    </div>

    <div class="form-group">
        <label for="type_vehicule">Type de Véhicule :</label>
        <input type="text" id="type_vehicule" name="type_vehicule" class="form-control">
    </div>

    <div class="form-group">
        <label for="statut_dispo">Statut Disponibilité :</label>
        <select id="statut_dispo" name="statut_dispo" class="form-control">
            <option value="1">Disponible</option>
            <option value="0">Indisponible</option>
        </select>
    </div>

    <div class="form-group">
        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
    </div>

    <button type="submit" name="addVehicle" class="btn btn-primary mt-2">Enregistrer</button>
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";