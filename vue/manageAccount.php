<?php ob_start(); ?>

<div>
    <a href="?action=createAccount" class="btn btn-primary mt-2">Ajouter un compte</a>
</div>

<div class="mt-3">
    <table class="table table-striped text-center">
            <tr>
                <th>Civilité</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Login</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Date d'inscription</th>
                <th>Téléphone</th>
                <th>Action</th>
            </tr>
            <?php foreach($accounts as $account): ?>
                <tr>
                    <td> <?= $account->getCivilite() ?> </td>
                    <td> <?= $account->getPrenom() ?> </td>
                    <td> <?= $account->getNom() ?> </td>
                    <td> <?= $account->getLogin() ?> </td>
                    <td> <?= $account->getEmail() ?> </td>
                    <td> <?= $account->getRole() ?> </td>
                    <td> <?= $account->getDateInscription() ?> </td>
                    <td> <?= $account->getTel() ?> </td>
                    <td>
                        <a href="?action=modifierCompte&id=<?= $account->getIdPersonne() ?>" class="btn btn-primary mt-2">Modifier</a>
                        <a href="?action=supprimerCompte&id=<?= $account->getIdPersonne()?>" class="btn btn-primary mt-2 accountSuppr">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>


<?php 
$contenu = ob_get_clean();
include "vue/template.php";