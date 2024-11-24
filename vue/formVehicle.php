<?php ob_start(); ?>

<h6 id="messageErreurV"></h6>

<form action="" id="vehicle_form" method="POST" enctype="multipart/form-data" class="p-4 bg-light rounded shadow-sm">
    <div class="form-group">
        <label for="marque"><span class="text-danger">*</span> Marque :</label>
        <input type="text" id="marque" name="marque" class="form-control" maxlength="25" value="<?php if(isset($vehicule)) { echo $vehicule->getMarque();} ?>">
    </div>

    <div class="form-group">
        <label for="modele"><span class="text-danger">*</span> Modèle :</label>
        <input type="text" id="modele" name="modele" class="form-control" maxlength="25" value="<?php if(isset($vehicule)) { echo $vehicule->getModele();} ?>">
    </div>

    <div class="form-group">
        <label for="matricule"><span class="text-danger">*</span> Matricule :</label>
        <input type="text" id="matricule" name="matricule" class="form-control" maxlength="25" value="<?php if(isset($vehicule)) { echo $vehicule->getMatricule();} ?>">
    </div>

    <div class="form-group">
        <label for="prix_journalier"><span class="text-danger">*</span> Prix Journalier :</label>
        <input type="number" id="prix_journalier" name="prix_journalier" class="form-control" value="<?php if(isset($vehicule)) { echo $vehicule->getPrixJournalier();} ?>">
    </div>

    <div class="form-group">
        <label for="type_vehicule"><span class="text-danger">*</span> Type de Véhicule :</label>
        <select id="type_vehicule" name="type_vehicule" class="form-control">
        <?php 
            $selectedType = isset($vehicule) ? $vehicule->getTypeVehicule() : null;

            $options = [
                "voiture" => "Voiture",
                "2_roues" => "2 roues",
                "camion" => "Camion",
            ];

            foreach ($options as $value => $label) {
                $selected = ($value === $selectedType) ? "selected" : "";
                echo "<option value=\"$value\" $selected>$label</option>";
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="statut_dispo"><span class="text-danger">*</span> Statut Disponibilité :</label>
        <select id="statut_dispo" name="statut_dispo" class="form-control">
        <?php 
            $selectedDispo = isset($vehicule) ? $vehicule->getStatutDispo() : null;
            $options = [
            "1" => "Disponible",
            "0" => "Indisponible",
            ];
            foreach ($options as $value => $label) {
                $selected = ($value == $selectedDispo) ? "selected" : "";
                echo "<option value=\"$value\" $selected>$label</option>";
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo" class="form-control" accept="image/*" required>
    </div>

    <input type="submit" name="<?php if(isset($vehicule)) {echo "modifyVehicle";} else {echo "addVehicle";} ?>" class="btn btn-primary mt-2" value="Enregistrer">
</form>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";