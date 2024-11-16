<div class="d-flex justify-content-center">
    <h5>Réservations</h5>
</div>

<form action="" method="POST" class="p-4 bg-light rounded shadow-sm">
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
    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>