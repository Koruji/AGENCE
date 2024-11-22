<?php ob_start(); ?>
<?php
/** @var Account $compte */
?>

<h6 id="messageErreur"></h6>
<h6 class="text-danger"><?php if(isset($messageErreurLogin)) { echo '<i class="bi bi-exclamation-triangle-fill"></i> ' . htmlspecialchars($messageErreurLogin);} ?></h6>

<form action="" id="inscription_form" method="POST" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="civilite"><span class="text-danger">*</span> Civilité :</label>
        <select id="civilite" name="civilite" class="form-control" value="<?php if(isset($compte)) { echo $compte->getCivilite();} ?>">
            <option value="Mr">Mr</option>
            <option value="Mme">Mme</option>
        </select>
    </div>

    <div class="form-group">
        <label for="prenom"><span class="text-danger">*</span> Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="form-control" value="<?php if(isset($compte)) { echo $compte->getPrenom();} ?>">
    </div>

    <div class="form-group">
        <label for="nom"><span class="text-danger">*</span> Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" value="<?php if(isset($compte)) { echo $compte->getNom();} ?>">
    </div>

    <div class="form-group">
        <label for="login"><span class="text-danger">*</span> Login :</label>
        <input type="text" id="login" name="login" class="form-control" value="<?php if(isset($compte)) { echo $compte->getLogin();} ?>">
    </div>

    <div class="form-group">
        <label for="email"><span class="text-danger">*</span> Email :</label>
        <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($compte)) { echo $compte->getEmail();} ?>">
    </div>

    <?php if(isset($_SESSION['user'])): ?>
        <?php if(unserialize($_SESSION['user'])->getRole() === "ADMIN"): ?>
            <div class="form-group">
                <label for="role">Rôle :</label>
                <select id="role" name="role" class="form-control" value="<?php if(isset($compte)) { echo $compte->getRole();} ?>">
                    <option value="CLIENT">Client</option>
                    <option value="ADMIN">Admin</option>
                </select>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="form-group">
        <label for="tel"><span class="text-danger">*</span> Téléphone :</label>
        <input type="text" id="tel" name="tel" class="form-control" value="<?php if(isset($compte)) { echo $compte->getTel();} ?>">
    </div>

    <?php if(!isset($compte)) : ?>
        <div class="form-group">
            <label for="mdp"><span class="text-danger">*</span> Mot de Passe :</label>
            <input type="password" id="mdp" name="mdp" class="form-control">
        </div>
    <?php endif; ?>

    <input type="submit" class="btn btn-primary mt-2" name="<?php if(isset($compte)) {echo "modifyAccount";} else {echo "createAccount";} ?>" value="Enregistrer">
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";