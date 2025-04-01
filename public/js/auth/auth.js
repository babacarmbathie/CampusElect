/**
 * CAMPUS ELECT - Script principal d'authentification
 * ======================================
 * Ce fichier initialise tous les modules d'authentification
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les validations de formulaire
    if (window.authValidation) {
        window.authValidation.init();
    }
    
    // Initialiser les éléments d'UI
    if (window.authUI) {
        window.authUI.init();
    }
}); 