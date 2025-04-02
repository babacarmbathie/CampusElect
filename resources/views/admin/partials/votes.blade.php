<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Votes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
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
        #votesChart {
            width: 100%;
            max-width: 100%;
        }
        .progress-bar {
            transition: width 1s ease;
        }

        /* Conteneur principal */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
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

    <h2>Gestion des Votes</h2>

    <!-- Conteneur principal -->
    <div class="container">

        <!-- Première rangée avec Total des Votants -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5><i class="fas fa-vote-yea"></i> Total des Votants</h5>
                        <h3 id="totalVotants">0</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deuxième rangée avec Graphique des votes et Résultats des Votes -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <canvas id="votesChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5>Résultats des Votes</h5>
                        <div id="resultatsVotes">
                            <!-- Résultats dynamiques -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialiser le graphique avec des données vides
        const ctx = document.getElementById('votesChart').getContext('2d');
        let votesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    label: 'Nombre de Votes',
                    data: [],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Répartition des Votes'
                    }
                }
            }
        });

        // Configuration pour les requêtes AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fonction pour mettre à jour les données
        function updateVotesData() {
            $.ajax({
                url: '{{ route("votes.getVotes") }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Mise à jour du total des votants
                    $('#totalVotants').text(data.totalVotes);

                    // Extraction des données pour le graphique
                    const candidateNames = [];
                    const candidateVotes = [];
                    let resultatsHTML = '';

                    data.candidates.forEach(function(candidate) {
                        candidateNames.push(candidate.name);
                        candidateVotes.push(candidate.votes);

                        // Calcul du pourcentage
                        const percentage = data.totalVotes > 0 
                            ? ((candidate.votes / data.totalVotes) * 100).toFixed(2) 
                            : 0;

                        // HTML pour les barres de progression
                        resultatsHTML += `
                            <div class="mb-3">
                                <h6>${candidate.name}</h6>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: ${percentage}%;" 
                                         aria-valuenow="${percentage}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        ${percentage}%
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    // Mise à jour du graphique
                    votesChart.data.labels = candidateNames;
                    votesChart.data.datasets[0].data = candidateVotes;
                    votesChart.update();

                    // Mise à jour des résultats
                    $('#resultatsVotes').html(resultatsHTML);
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de la récupération des votes:', error);
                }
            });
        }

        // Appeler la fonction au chargement de la page
        $(document).ready(function() {
            updateVotesData();
            
            // Mettre à jour les données toutes les 3 secondes
            setInterval(updateVotesData, 3000);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>