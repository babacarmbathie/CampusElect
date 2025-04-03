<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Votes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; }
        #votesChart { max-height: 400px; }
        .progress { height: 25px; margin-bottom: 10px; }
        .progress-bar { transition: width 0.6s ease; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Gestion des Votes</h2>
    
    <!-- Carte du total des votants -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total des Votants</h5>
                    <h2 id="totalVotants">0</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique et résultats -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="votesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Résultats détaillés</h5>
                    <div id="resultatsVotes"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Variable globale pour le graphique
let votesChart = null;

function initChart() {
    const ctx = document.getElementById('votesChart').getContext('2d');
    votesChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', 
                    '#4BC0C0', '#9966FF', '#FF9F40'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                title: {
                    display: true,
                    text: 'Répartition des votes',
                    font: { size: 16 }
                }
            }
        }
    });
}

function updateVotesData() {
    $.ajax({
        url: '/votes/data',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log("Données reçues:", data);
            
            // Mettre à jour le total des votants
            $('#totalVotants').text(data.totalVotes);
            
            // Mettre à jour le graphique
            if (votesChart) {
                votesChart.data.labels = data.candidates.map(c => c.name);
                votesChart.data.datasets[0].data = data.candidates.map(c => c.votes);
                votesChart.update();
            }
            
            // Mettre à jour les résultats détaillés
            let html = '';
            data.candidates.forEach(candidate => {
                const percentage = data.totalVotes > 0 
                    ? Math.round((candidate.votes / data.totalVotes) * 100)
                    : 0;
                
                html += `
                    <div class="mb-3">
                        <h6>${candidate.name}</h6>
                        <div class="progress">
                            <div class="progress-bar bg-success" 
                                 style="width: ${percentage}%">
                                ${percentage}% (${candidate.votes} votes)
                            </div>
                        </div>
                    </div>`;
            });
            $('#resultatsVotes').html(html);
        },
        error: function(xhr) {
            console.error("Erreur AJAX:", xhr.responseText);
        }
    });
}

$(document).ready(function() {
    initChart();
    updateVotesData();
    setInterval(updateVotesData, 3000);
});
</script>

</body>
</html>