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
                en vous créant un compte.
            </p>
            <input class="btn btn-primary mt-2" name="create" value="Créer un compte">
        </div>
    </div>
</form>