<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Administrateur - CampusElect</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #3490dc;
            --secondary-color: #6c757d;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
        }
        
        body {
            background-color: var(--light-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('{{ asset('images/ugb.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        
        .sidebar {
            height: 100vh;
            width: var(--sidebar-width);
            position: fixed;
            background: var(--dark-color);
            color: white;
            padding-top: 1rem;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            min-height: 100vh;
            transition: all 0.3s;
            width: calc(100% - var(--sidebar-width));
        }
        
        .section {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .section.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h4 class="text-center mb-0">CampusElect</h4>
                <small class="d-block text-center text-muted">Panel Administrateur</small>
            </div>
            
            <a href="#" class="active" data-section="dashboard">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
            <a href="#" data-section="etudiants">
                <i class="fas fa-users"></i> Étudiants
            </a>

            <a href="#" data-section="candidats">
        <i class="fas fa-user-tie"></i> Candidats
    </a>
            <!-- Autres liens du menu -->
            
            <div class="mt-auto p-3">
                <a href="{{ route('student.logout') }}" class="text-danger">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <!-- Main Content -->
<div class="content">
    <!-- Section Dashboard -->
    <div id="dashboard" class="section active">
        @include('admin.partials.dashboard')
    </div>

    <!-- Section Étudiants -->
    <div id="etudiants" class="section">
        @include('admin.partials.etudiants')
    </div>

    <!-- Section Candidats -->
    <div id="candidats" class="section">
        @include('admin.partials.candidats')
    </div>

    <!-- Section Votes -->
    <div id="votes" class="section">
        @include('admin.partials.votes')
    </div>

    <!-- Section Élections -->
    <div id="elections" class="section">
        @include('admin.partials.elections')
    </div>
</div>

 

            <div id="etudiants" class="section">
                <!-- Chargement via AJAX -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
            <!-- Autres sections -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Gestion de la navigation entre les sections
        $('.sidebar a[data-section]').click(function(e) {
            e.preventDefault();
            $('.sidebar a').removeClass('active');
            $(this).addClass('active');
            $('.section').removeClass('active');
            $('#' + $(this).data('section')).addClass('active');
        });

        // Gestion du formulaire d'ajout de candidat
        $('#showFormBtn').click(function(e) {
            e.preventDefault();
            $('#candidateFormContainer').removeClass('d-none');
            $(this).addClass('d-none');
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });

        $('#cancelFormBtn').click(function(e) {
            e.preventDefault();
            $('#candidateFormContainer').addClass('d-none');
            $('#showFormBtn').removeClass('d-none');
            $('#candidateForm')[0].reset();
            $('#imagePreview').hide();
        });

        // Prévisualisation de l'image
        $('#photo').change(function() {
            const file = this.files[0];
            const preview = $('#previewImg');
            const previewDiv = $('#imagePreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.attr('src', e.target.result);
                    previewDiv.show();
                }
                reader.readAsDataURL(file);
            } else {
                previewDiv.hide();
            }
        });
    });
</script>
</body>
</html>