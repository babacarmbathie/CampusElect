<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Couleurs personnalisées */
        :root {
            --marron-fonce: #3E2723;
            --marron-clair: #6D4C41;
            --bleu-primaire: #0275d8;
            --vert-primaire: #28a745;
            --rouge-primaire: #dc3545;
            --gris-clair: #f4f4f4;
            --gris-fonce: #495057;
        }

        body {
            background-color: var(--gris-clair);
            font-family: Arial, sans-serif;
        }

        h2 {
            color: var(--marron-fonce);
            text-align: center;
            margin-bottom: 30px;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card h5 {
            font-size: 1.1rem;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .card h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Styles pour chaque carte */
        .card.bg-primary {
            background-color: var(--bleu-primaire);
        }

        .card.bg-primary h5 {
            color: #fff;
        }

        .card.bg-primary h3 {
            color: #fff;
        }

        .card.bg-success {
            background-color: var(--vert-primaire);
        }

        .card.bg-success h5 {
            color: #fff;
        }

        .card.bg-success h3 {
            color: #fff;
        }

        .card.bg-danger {
            background-color: var(--rouge-primaire);
        }

        .card.bg-danger h5 {
            color: #fff;
        }

        .card.bg-danger h3 {
            color: #fff;
        }

        .row {
            margin-top: 20px;
        }

        /* Espacement et alignement des nouveaux éléments */
        .progress-bar {
            height: 30px;
        }

        .alert-custom {
            background-color: var(--bleu-primaire);
            color: white;
            font-size: 1.2rem;
        }

        /* Design responsif */
        @media (max-width: 768px) {
            .col-md-4 {
                margin-bottom: 20px;
            }
            .table-responsive {
    width: 100%;
}

.table {
    width: 100%;
    table-layout: fixed; /* ou 'auto' si besoin */
}

            
        }
    </style>
</head>
<body>

<div class="container-fluid">  <!-- Changé ici -->
        <h2>Tableau de Bord</h2>

        <!-- Notifications -->
        <div class="alert alert-custom alert-dismissible fade show" role="alert">
            <strong>Nouvelle mise à jour disponible!</strong> Cliquez ici pour voir les détails.
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Row de cartes principales -->
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 bg-primary text-white">
                    <h5><i class="fas fa-users"></i> Étudiants</h5>
                    <h3>150</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 bg-success text-white">
                    <h5><i class="fas fa-user-tie"></i> Candidats</h5>
                    <h3>10</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 bg-danger text-white">
                    <h5><i class="fas fa-vote-yea"></i> Votes</h5>
                    <h3>200</h3>
                </div>
            </div>
        </div>

        <!-- Row de graphiques -->
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5><i class="fas fa-chart-pie"></i> Répartition des Étudiants</h5>
                    <canvas id="studentChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h5><i class="fas fa-chart-bar"></i> Activité des Candidats</h5>
                    <canvas id="candidateChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Row de progression -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <h5><i class="fas fa-tasks"></i> Progrès des Votes</h5>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Graphique des étudiants (camembert)
        var ctx1 = document.getElementById('studentChart').getContext('2d');
        var studentChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Étudiants Actifs', 'Étudiants Inactifs'],
                datasets: [{
                    data: [130, 20],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 1
                }]
            }
        });

        // Graphique des candidats (barres)
        var ctx2 = document.getElementById('candidateChart').getContext('2d');
        var candidateChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Candidats',
                    data: [5, 8, 7, 9, 10, 6],
                    backgroundColor: '#0275d8',
                    borderColor: '#0056b3',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>
