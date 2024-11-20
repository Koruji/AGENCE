<?php ob_start(); ?>

<a href="?action=ajouterVehicule" class="btn btn-primary mt-2">Ajouter un véhicule</a>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";