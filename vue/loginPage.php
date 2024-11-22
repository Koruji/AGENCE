<?php ob_start(); ?>

<form action="" method="POST">
    
    <div class="d-flex justify-content-between">
        <div class="p-4 bg-light rounded shadow-sm" style="flex: 1; margin-right: 15px;">
                <h3>Se connecter</h3>
                <div class="form-group">
                    <label for="login">Login :</label>
                    <input type="text" id="login" name="login" class="form-control" maxlength="25" required>
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de Passe :</label>
                    <input type="password" id="mdp" name="mdp" class="form-control" required>
                </div>
                <input type="submit" class="btn btn-primary mt-2" name="connectAccount" value="Se connecter">
        </div>

        <div class="p-4 bg-light rounded shadow-sm" style="flex: 1;">
            <h3>Nouveau ?</h3>
            <p>
                Accéder au service de location de &copy; Rent - a - Car en toute simplicité
                en créant un compte.
            </p>
            <a href="?action=createAccount" class="btn btn-primary mt-2">Créer un compte</a>
        </div>
    </div>
</form>
<div class="flex-grow-2 bg-light rounded p-3 d-flex flex-column mt-3 shadow-sm">
    <h5 class="text-center">
        Véhicules disponibles
    </h5>
    <p>
        Envie de louer un véhicule ?
        Regardez notre sélection disponible à la location.
    </p>
    <a href="?action=listVehicle" class="btn btn-primary mt-2">Regarder les offres</a>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";
