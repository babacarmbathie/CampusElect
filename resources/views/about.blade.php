<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos de Nous</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/confetti/2.7.2/confetti.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="config.js" type="module"></script>
    <script src="script.js" type="module"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        <file-changes>
```css
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f5f9;
    color: #2c3e50;
    transition: background-color 0.3s, color 0.3s;
}

.bg-brown {
    background-color: #6B451D !important;
}

.text-brown {
    color: #6B451D !important;
}

.bg-light-brown {
    background-color: #A0785A !important;
}

header {
    background: linear-gradient(to right, #6B451D, #A0785A);
    color: #fff;
    padding: 1.5em 0;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s;
}

main {
    padding: 30px;
}

section {
    margin-bottom: 30px;
    background: linear-gradient(to bottom, #fff, #f9f9f9);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s;
}

section:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.team-member {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ecf0f1;
    border-radius: 8px;
    background: linear-gradient(to bottom, #f9f9f9, #fff);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: transform 0.2s;
}

.team-member:hover {
    transform: translateY(-5px);
}

.team-member img {
    width: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

.team-member h3 {
    color: #34495e;
    margin-bottom: 5px;
}

.team-member p {
    color: #7f8c8d;
    line-height: 1.6;
}


footer {
    text-align: center;
    padding: 1.5em 0;
    background: linear-gradient(to right, #A0785A, #6B451D);
    color: #fff;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s;
}


    </style>
</head>

<body class="bg-light">
    <header class="bg-brown text-white text-center py-3">
        <h1>À Propos de Nous</h1>
        <p>Créateurs de la plateforme de vote en ligne</p>
    </header>

    <main id="swup" class="container my-4">
        <section id="presentation" class="bg-white p-4 rounded shadow">
            <h2>Notre Équipe</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="team-member text-center">
                        <img src="https://avatars.githubusercontent.com/u/65403571?v=4" alt="Babacar MBathie"
                            class="img-fluid rounded-circle mb-3" style="width: 100px;">
                        <h3>Babacar MBathie</h3>
                        <p>Étudiant Entrepreneur, ingénieur informatique et en agriculture.</p>
                        <p>Téléphone: 761917181</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="team-member text-center">
                        <img src="https://avatars.githubusercontent.com/u/65403571?v=4" alt="Pape Doukoum TINE"
                            class="img-fluid rounded-circle mb-3" style="width: 100px;">
                        <h3>Pape Doukoum TINE</h3>
                        <p>Description à venir...</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="team-member text-center">
                        <img src="https://avatars.githubusercontent.com/u/65403571?v=4" alt="Harouna DIAW"
                            class="img-fluid rounded-circle mb-3" style="width: 100px;">
                        <h3>Harouna DIAW</h3>
                        <p>Description à venir...</p>
                    </div>
                </div>
            </div>

        </section>

        <section id="contact" class="bg-white p-4 rounded shadow">
            <h2>Contactez-nous</h2>
            <p>Pour toute question concernant la plateforme, n'hésitez pas à nous contacter.</p>
            <ul>
                <li>Babacar MBathie: 761917181</li>
                <li>Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="4e2b362b233e222b0e2b232f2722602d2123">[email&#160;protected]</a></li>
            </ul>
        </section>
    </main>

    <footer class="bg-brown text-white text-center py-3">
        <p>&copy; 2024 Notre Projet</p>
    </footer>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>