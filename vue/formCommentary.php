<?php ob_start(); ?>

<div class="d-flex justify-content-center">
    <h5>Votre réservation du <?= $selectReservation->modifyDate($selectReservation->getDateDebut())?></h5>
</div>

<form action="" method="POST" class="p-4 bg-light rounded shadow-sm">
    
<input type="hidden" name="idReservation" value="<?= htmlspecialchars($selectReservation->getIdReservation()); ?>">

    <div class="form-group mb-3">
        <label for="commentaire">Commentaire :</label>
        <textarea id="commentaire" name="commentaire" class="form-control" required></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="note">Note :</label>
        <input type="number" id="note" name="note" class="form-control" min="1" max="5" required>
    </div>
   
    <input type="submit" name="postComment" class="btn btn-primary mt-2" value="Poster">
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";