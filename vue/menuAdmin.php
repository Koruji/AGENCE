<?php ob_start(); ?>

<div class="container vh-100 d-flex">
    <div class="w-50 bg-light rounded p-3 me-3 d-flex flex-column">
        <h5 class="text-center">
            Commentaires des clients
        </h5>
        <p> A compléter avec les évaluations déjà mise !</p>
    </div>

    <div class="w-50 d-flex flex-column">
        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column">
            <h5 class="text-center">
                Nombre de clients
            </h5>
            <p class="text-center display-1 m-0"><?php 
                echo count($nombreClients);
            ?></p>
        </div>

        <div class="flex-fill bg-light rounded p-3 d-flex flex-column">
            <h5 class="text-center">
                Nombre de véhicules enregistrés
            </h5>
            <p> METTRE UN GROS CHIFFRE </p>
        </div>
    </div>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";