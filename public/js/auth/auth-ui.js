/**
 * CAMPUS ELECT - Scripts d'UI pour l'authentification
 * ======================================
 */

// Animation des champs de formulaire au focus
function setupFormFieldAnimations() {
    const inputs = document.querySelectorAll('input');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
}

// Changement de style de la navbar au scroll
function setupNavbarScroll() {
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;

        if (window.scrollY > 50) {
            navbar.style.backgroundColor = 'rgba(58, 42, 31, 0.95)';
            navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
        } else {
            navbar.style.backgroundColor = 'rgba(58, 42, 31, 0.9)';
            navbar.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';
        }
    });
}

// Gestion des animations de formulaire et CSRF token
function setupFormAnimations() {
    const forms = document.querySelectorAll('form');
    
    // Ajout du token CSRF à tous les formulaires
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        forms.forEach(form => {
            if (!form.querySelector('input[name="_token"]')) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token.getAttribute('content');
                form.appendChild(csrfInput);
            }
        });
    }
    
    forms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Récupération des éléments
            const submitBtn = this.querySelector('.submit-btn');
            const formBox = this.closest('.form-box');
            const inputs = this.querySelectorAll('.input-group');
            
            if (!submitBtn || !formBox) return this.submit();
            
            // Sauvegarde du texte original du bouton
            const originalText = submitBtn.textContent;
            
            // Animation de début
            submitBtn.classList.add('loading');
            formBox.classList.add('submitting');
            
            // Animation des champs
            inputs.forEach((input, index) => {
                setTimeout(() => {
                    input.style.animation = 'inputPulse 0.5s ease-in-out';
                }, index * 100);
            });
            
            try {
                // Attendre une courte période pour l'effet visuel
                await new Promise(resolve => setTimeout(resolve, 800));
                
                // Animation de succès
                submitBtn.classList.remove('loading');
                submitBtn.classList.add('success');
                
                // Réinitialisation des animations des champs
                inputs.forEach(input => {
                    input.style.animation = '';
                });
                
                // Attente de la fin de l'animation de succès
                await new Promise(resolve => setTimeout(resolve, 500));
                
                // Soumission réelle du formulaire
                this.submit();
                
            } catch (error) {
                // En cas d'erreur
                submitBtn.classList.remove('loading');
                submitBtn.classList.add('error');
                formBox.classList.remove('submitting');
                
                // Réinitialisation après 2 secondes
                setTimeout(() => {
                    submitBtn.classList.remove('error');
                    submitBtn.textContent = originalText;
                }, 2000);
            }
        });
    });
}

// Afficher des messages flash
function showFlashMessage(type, message) {
    const flashContainer = document.getElementById('flash-messages');
    if (!flashContainer) return;
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show`;
    alert.role = 'alert';
    
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    flashContainer.appendChild(alert);
    
    // Auto-dismissible après 5 secondes
    setTimeout(() => {
        alert.classList.remove('show');
        setTimeout(() => alert.remove(), 500);
    }, 5000);
}

// Initialisation des éléments d'UI
function initUI() {
    setupFormFieldAnimations();
    setupFormAnimations();
    setupNavbarScroll();
}

// Exporter les fonctions pour les utiliser dans d'autres fichiers
window.authUI = {
    init: initUI,
    showFlashMessage: showFlashMessage
}; 