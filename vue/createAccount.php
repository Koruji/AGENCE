<?php ob_start(); ?>

<form action="" method="POST" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="civilite"><span class="text-danger">*</span> Civilité :</label>
        <select id="civilite" name="civilite" class="form-control" required>
            <option value="Mr">Mr</option>
            <option value="Mme">Mme</option>
        </select>
    </div>

    <div class="form-group">
        <label for="prenom"><span class="text-danger">*</span> Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="nom"><span class="text-danger">*</span> Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="login"><span class="text-danger">*</span> Login :</label>
        <input type="text" id="login" name="login" class="form-control" maxlength="25" required>
    </div>

    <div class="form-group">
        <label for="email"><span class="text-danger">*</span> Email :</label>
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
        <label for="tel"><span class="text-danger">*</span> Téléphone :</label>
        <input type="text" id="tel" name="tel" class="form-control" maxlength="20" required>
    </div>

    <div class="form-group">
        <label for="mdp"><span class="text-danger">*</span> Mot de Passe :</label>
        <input type="password" id="mdp" name="mdp" class="form-control" required>
    </div>

    <input type="submit" class="btn btn-primary mt-2" name="createAccount" value="Enregistrer">
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";