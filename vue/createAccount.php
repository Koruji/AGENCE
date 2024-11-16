<form action="" method="POST" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="civilite">Civilité :</label>
        <select id="civilite" name="civilite" class="form-control" required>
            <option value="Mr">Mr</option>
            <option value="Mme">Mme</option>
        </select>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" class="form-control" maxlength="50" required>
    </div>

    <!-- 
    <div class="form-group">
        <label for="role">Rôle :</label>
        <select id="role" name="role" class="form-control">
            <option value="CLIENT">Client</option>
            <option value="ADMIN">Admin</option>
        </select>
    </div>
    -->

    <div class="form-group">
        <label for="tel">Téléphone :</label>
        <input type="text" id="tel" name="tel" class="form-control" maxlength="20" required>
    </div>

    <div class="form-group">
        <label for="mdp">Mot de Passe :</label>
        <input type="password" id="mdp" name="mdp" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
</form>