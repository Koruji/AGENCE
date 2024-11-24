<?php ob_start(); ?>

<h4 class="mb-3 text-center">Bonjour <?= unserialize($_SESSION['user'])->getPrenom() ?> ! <i class="bi bi-sun-fill text-warning"></i></h4>
<div class="conteneur">
    <div class="bg-light rounded p-3 mb-3 shadow-sm colonneGauche">
        <h5 class="text-center mb-3">
            Commentaires des clients
        </h5>

        <?php foreach($commentaires as $comment): ?>
            <p class="card-text fst-italic mb-3 ">
                "<?= htmlspecialchars($comment->getCommentaire()); ?>"
            </p>
            <h6 class="card-title mb-0 ">
                <?php 
                $modelAccount = new AccountModel();
                $client = $modelAccount->findAccountById($comment->getIdPersonne());
                echo $client->getNom() . " " . $client->getPrenom(); ?>
            </h6>

            <p class="card-text text-muted mb-0">
                <th><?php 
                    $numberStar = $comment->getNote();
                    $affichageNote = "";
                    for ($i = 0; $i < $numberStar; $i++) {
                        $affichageNote .= '<i class="bi bi-star-fill"></i>';
                    }
                    echo $affichageNote;                            
                ?></th>
            </p>

            <hr>
        <?php endforeach; ?>

    </div>

    <div class="colonneDroite">
        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm">
            <h5 class="text-center">
                Nombre de clients
            </h5>
            <p class="text-center display-1 m-0"><?php 
                echo count($nombreClients);
            ?></p>
        </div>

        <div class="flex-fill bg-light rounded p-3 mb-3 d-flex flex-column shadow-sm">
            <h5 class="text-center">
                Nombre de véhicules enregistrés
            </h5>
            <p class="text-center display-1 m-0">
                <?php echo count($nombreVehicules) ?>
                <table class="table mt-3">
                    <?php 
                    $compteurs = [];
                    foreach ($nombreVehicules as $vehicule) {
                        $type = $vehicule->getTypeVehicule();
                        if (!isset($compteurs[$type])) {
                            $compteurs[$type] = 0;
                        }
                        $compteurs[$type]++;
                    }
                    foreach ($compteurs as $type => $nombre): ?>
                        <tr>
                            <td><?= $type ?></td>
                            <td><?= $nombre ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                
            </p>
        </div>
    </div>
</div>

<?php 
$contenu = ob_get_clean();
include "vue/template.php";