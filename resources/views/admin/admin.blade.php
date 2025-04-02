<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Administrateur - CampusElect</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-width-collapsed: 70px;
            --primary-color: #5E2C1A;
            --secondary-color: #B88B4A;
            --dark-color: #2D1810;
            --light-color: #F3E9DC;
            --transition: all 0.3s ease-in-out;
        }
        
        body {
            background-color: var(--light-color);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        
        .sidebar {
            height: 100vh;
            width: var(--sidebar-width);
            position: fixed;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
            color: white;
            padding-top: 1.5rem;
            transition: var(--transition);
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
            text-align: center;
        }

        .sidebar-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            display: block;
            transition: var(--transition);
            padding: 0.5rem;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .sidebar-header h4 {
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
            color: white;
        }

        .sidebar-header small {
            color: rgba(255,255,255,0.7);
            font-size: 0.875rem;
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar.collapsed .sidebar-text,
        .sidebar.collapsed .sidebar-header h4,
        .sidebar.collapsed .sidebar-header small {
            display: none;
        }

        .sidebar.collapsed .sidebar-logo {
            width: 50px;
            height: 50px;
            margin: 0 auto;
            padding: 0.25rem;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 0.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar.collapsed a {
            justify-content: center;
            padding: 1rem;
            margin: 0.5rem;
            position: relative;
        }

        .sidebar.collapsed a i {
            margin: 0;
            font-size: 1.4rem;
            width: 40px;
            height: 40px;
            border-radius: 0.75rem;
        }

        /* Tooltip pour le mode replié */
        .sidebar.collapsed a::after {
            content: attr(data-title);
            position: absolute;
            left: calc(100% + 10px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--dark-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .sidebar.collapsed a::before {
            content: '';
            position: absolute;
            left: calc(100% + 5px);
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: var(--dark-color);
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease-in-out;
            z-index: 1000;
        }

        .sidebar.collapsed a:hover::after,
        .sidebar.collapsed a:hover::before {
            opacity: 1;
            visibility: visible;
        }

        .sidebar.collapsed a.active {
            background: var(--secondary-color);
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .sidebar.collapsed a:hover {
            transform: scale(1.1);
            background: rgba(255,255,255,0.2);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: var(--transition);
            margin: 0.5rem 0.75rem;
            border-radius: 0.75rem;
            position: relative;
            overflow: hidden;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: var(--secondary-color);
            color: var(--primary-color);
            font-weight: 500;
        }

        .sidebar a i {
            margin-right: 1rem;
            font-size: 1.25rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            border-radius: 0.5rem;
            transition: var(--transition);
        }

        .sidebar a:hover i {
            background: var(--secondary-color);
            color: var(--primary-color);
            transform: rotate(360deg);
        }

        .sidebar a.active i {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .sidebar-toggle {
            position: fixed;
            top: 1rem;
            left: var(--sidebar-width);
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0 0.5rem 0.5rem 0;
            padding: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .sidebar-toggle.collapsed {
            left: var(--sidebar-width-collapsed);
        }

        .sidebar-toggle i {
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed + .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            transition: var(--transition);
            width: calc(100% - var(--sidebar-width));
            background: var(--light-color);
        }

        .content.collapsed {
            margin-left: var(--sidebar-width-collapsed);
            width: calc(100% - var(--sidebar-width-collapsed));
        }

        /* Styles pour les modals */
        .modal-backdrop {
            z-index: 99990 !important;
        }
        
        .modal {
            z-index: 99999 !important;
        }
        
        .modal-content {
            box-shadow: 0 5px 30px rgba(0,0,0,0.5) !important;
        }

        .section {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .section.active {
            display: block;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: var(--transition);
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
        }

        .btn {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: var(--dark-color);
            border-color: var(--dark-color);
        }

        .table {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
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
            .sidebar-toggle {
                display: flex;
            }
        }
    </style>

    <!-- Styles globaux pour les modaux et SweetAlert2 -->
    <style>
        /* Z-index élevés pour les modaux */
        .modal {
            z-index: 99999999 !important;
        }
        
        .modal-backdrop {
            z-index: 99999990 !important;
        }
        
        /* Styles pour SweetAlert2 */
        .swal2-container {
            z-index: 999999999 !important;
        }
        
        .swal2-popup {
            border-radius: 15px !important;
            box-shadow: 0 10px 50px rgba(0,0,0,0.5) !important;
        }
        
        .swal2-title {
            color: var(--primary-color) !important;
        }
        
        /* Assurer que la boîte de dialogue est bien centrée */
        .modal-dialog-centered {
            display: flex !important;
            align-items: center !important;
            min-height: calc(100% - 3.5rem) !important;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <x-logo class="sidebar-logo" />
                <h4>CampusElect</h4>
                <small>Panel Administrateur</small>
            </div>
            
            <a href="#" class="active" data-section="dashboard" data-title="Tableau de bord">
                <i class="fas fa-chart-pie"></i>
                <span class="sidebar-text">Tableau de bord</span>
            </a>
            <a href="#" data-section="etudiants" data-title="Étudiants">
                <i class="fas fa-user-graduate"></i>
                <span class="sidebar-text">Étudiants</span>
            </a>
            <a href="#" data-section="candidats" data-title="Candidats">
                <i class="fas fa-user-tie"></i>
                <span class="sidebar-text">Candidats</span>
            </a>
            <a href="#" data-section="votes" data-title="Votes">
                <i class="fas fa-check-square"></i>
                <span class="sidebar-text">Votes</span>
            </a>
            <a href="#" data-section="elections" data-title="Élections">
                <i class="fas fa-vote-yea"></i>
                <span class="sidebar-text">Élections</span>
            </a>
            
            <div class="mt-auto p-3">
                <a href="{{ route('student.logout') }}" class="text-danger" data-title="Déconnexion">
                    <i class="fas fa-power-off"></i>
                    <span class="sidebar-text">Déconnexion</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </button>

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Gestion du toggle de la sidebar
        $('.sidebar-toggle').click(function() {
            $('.sidebar').toggleClass('collapsed');
            $('.sidebar-toggle').toggleClass('collapsed');
            $('.content').toggleClass('collapsed');
            
            // Rotation de l'icône
            $(this).find('i').toggleClass('fa-rotate-180');
        });

        // Gestion de la navigation entre les sections
        $('.sidebar a[data-section]').click(function(e) {
            e.preventDefault();
            if (!$(this).hasClass('has-submenu')) {
                $('.sidebar a').removeClass('active');
                $(this).addClass('active');
                $('.section').removeClass('active');
                $('#' + $(this).data('section')).addClass('active');
            }
        });
        
        // Amélioration de l'affichage des modaux
        function setupModals() {
            // Gérer l'ouverture des modaux
            $(document).on('show.bs.modal', '.modal', function(event) {
                // Supprimer tous les backdrops existants pour éviter les superpositions
                $('.modal-backdrop').remove();
                
                // Définir un z-index très élevé
                $(this).css('z-index', '99999999');
                
                // S'assurer que le modal est visible et au premier plan
                $(this).addClass('modal-force-top');
                
                // Temporisation pour s'assurer que le backdrop est correctement positionné
                setTimeout(() => {
                    $('.modal-backdrop').css({
                        'z-index': '99999990',
                        'opacity': '0.5'
                    });
                    
                    // Désactiver les interactions avec les éléments en arrière-plan
                    $('body').addClass('modal-open');
                    $('body > *:not(.modal):not(.modal-backdrop):not(.swal2-container)').css({
                        'pointer-events': 'none'
                    });
                }, 10);
            });
            
            // Gérer la fermeture des modaux
            $(document).on('hidden.bs.modal', '.modal', function(event) {
                // Supprimer les classes et styles ajoutés
                $(this).removeClass('modal-force-top');
                
                // Réactiver les interactions
                $('body > *').css({
                    'pointer-events': '',
                    'filter': ''
                });
                
                // Nettoyer tout backdrop résiduel
                if ($('.modal:visible').length === 0) {
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                }
            });
        }
        
        // Initialiser la configuration des modaux
        setupModals();
        
        // Assurer que SweetAlert2 s'affiche toujours au-dessus de tout
        const originalSwal = Swal.fire;
        Swal.fire = function() {
            // Nettoyer tout backdrop et modal ouvert
            $('.modal-backdrop').remove();
            $('.modal').modal('hide');
            
            // Appeler la fonction originale avec les arguments
            return originalSwal.apply(this, arguments);
        };
    });
    </script>
</body>
</html>