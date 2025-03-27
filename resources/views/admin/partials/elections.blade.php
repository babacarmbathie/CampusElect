<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Élections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Application d'un fond de page */
        body {
            background: #f4f6f9;
            padding: 20px;
        }
        h2 {
            color: #8E4B3A; /* Titre en marron */
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card h5 {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-body {
            text-align: center;
        }
        .card .btn {
            width: 100%;
            margin-top: 10px;
        }
        #countdown {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Conteneur principal pour un meilleur cadre */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .row {
            margin-bottom: 20px;
        }

        /* Espacement et styles des cards */
        .card {
            padding: 20px;
            margin: 10px;
        }

        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <h2>Gestion des Élections</h2>
    
    <!-- Conteneur principal -->
    <div class="container">
        <!-- Première rangée avec UFR et Dates des Élections -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5><i class="fas fa-university"></i> UFR Organisatrice</h5>
                        <p>UFR Sciences et Technologies</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5><i class="fas fa-calendar-alt"></i> Dates des Élections</h5>
                        <p>Début : 2023-10-01</p>
                        <p>Fin : 2023-10-31</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deuxième rangée avec Statut des Élections et Actions -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
            <div class="col">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5><i class="fas fa-info-circle"></i> Statut des Élections</h5>
                        <p>En cours</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5><i class="fas fa-exclamation-triangle"></i> Actions</h5>
                        <button class="btn btn-light">Démarrer les Élections</button>
                        <button class="btn btn-light mt-2">Arrêter les Élections</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Troisième rangée avec Temps Restant -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h5><i class="fas fa-clock"></i> Temps Restant</h5>
                        <p id="countdown">Calcul en cours...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Compte à rebours
        const endDate = new Date('2023-10-31T23:59:59').getTime();
        const countdown = document.getElementById('countdown');

        setInterval(() => {
            const now = new Date().getTime();
            const distance = endDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdown.innerHTML = `${days}j ${hours}h ${minutes}m ${seconds}s`;
        }, 1000);
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
