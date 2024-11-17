<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Location de véhicules</title>
</head>
<body class="container">

    <header class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-4 border-bottom">

        <a class="d-flex align-items-center text-dark text-decoration-none me-3">
            <i class="bi bi-car-front" style="font-size: 40px; color: black; margin-right: 20px;"></i>
            <span class="fs-4">Rent - a - Car</span>
        </a>

        <?php if(isset($_SESSION['user'])): ?>
            <div class="vr" style="height: 40px;"></div>

            <ul class="nav nav-pills mx-3">
                <!-- ADMINISTRATEUR -->
                <?php if( unserialize($_SESSION['user'])->getRole() == "ADMIN" ): ?>
                    <li class="nav-item">
                        <a href="" class="nav-link text-dark" style="background-color: white; border-radius: 10px;">Gérer les véhicules</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-dark" style="background-color: white; border-radius: 10px;">Gérer les utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-dark" style="background-color: white; border-radius: 10px;">Gérer les réservations</a>
                    </li>
                <?php endif; ?>

                <!-- CLIENT -->
                <?php if( unserialize($_SESSION['user'])->getRole() == "CLIENT" ): ?>
                    <li class="nav-item">
                        <a href="" class="nav-link text-dark" style="background-color: white; border-radius: 10px;">Faire une réservation</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-dark" style="background-color: white; border-radius: 10px;">Commentaires et notes</a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="text-end">
                <a href="?action=logout" class="btn btn-danger">Déconnexion</a>
            </div>
        <?php endif; ?>
    </header>

    <main class="container-fluid">
        <?= $contenu ?? ''; ?>
    </main>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">&copy; Rent - a - Car</p>

        <a class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <i class="bi bi-car-front" style="font-size: 40px; color: black; margin-right: 20px;"></i>
        </a>
    </footer>

    <script src="app.js"></script>

</body>
</html>


