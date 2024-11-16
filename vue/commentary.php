<div class="d-flex justify-content-center">
    <h5>Commentaires et notes</h5>
</div>

<form action="" method="POST" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="commentaire">Commentaire :</label>
        <textarea id="commentaire" name="commentaire" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="note">Note :</label>
        <input type="number" id="note" name="note" class="form-control" min="1" max="5" required>
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
    <button type="submit" class="btn btn-primary mt-2">Poster</button>
</form>