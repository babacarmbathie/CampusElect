/**
 * CAMPUS ELECT - Scripts d'authentification
 * ======================================
 * Table des matières :
 * 1. Validation des formulaires
 * 2. Animations et effets
 * 3. Navigation
 */

// 1. Validation des formulaires
// ===========================

// Validation du champ de connexion (email ou code étudiant)
function validateLoginField() {
    const loginField = document.getElementById('login');
    if (!loginField) return;

    loginField.addEventListener('input', function() {
        const value = this.value;
        const emailRegex = /^[^\s@]+@ugb\.edu\.sn$/;
        const codeRegex = /^P[0-9]{4,}$/;
        
        let isValid = false;
        if (value.includes('@')) {
            isValid = emailRegex.test(value);
        } else {
            isValid = codeRegex.test(value.toUpperCase());
        }
        
        toggleValidationIcons(this, isValid);
    });
}

// Validation de l'email pour l'inscription
function validateEmail() {
    const emailField = document.getElementById('email');
    if (!emailField) return;

    emailField.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@ugb\.edu\.sn$/;
        const isValid = emailRegex.test(this.value);
        toggleValidationIcons(this, isValid);
        toggleHelpText('emailHelp', !isValid);
    });

    emailField.addEventListener('focus', () => toggleHelpText('emailHelp', true));
    emailField.addEventListener('blur', () => toggleHelpText('emailHelp', false));
}

// Validation du code étudiant pour l'inscription
function validateStudentCode() {
    const codeField = document.getElementById('student_code');
    if (!codeField) return;

    codeField.addEventListener('input', function() {
        const codeRegex = /^P[0-9]{4,}$/;
        const isValid = codeRegex.test(this.value);
        toggleValidationIcons(this, isValid);
        toggleHelpText('codeHelp', !isValid);
    });

    codeField.addEventListener('focus', () => toggleHelpText('codeHelp', true));
    codeField.addEventListener('blur', () => toggleHelpText('codeHelp', false));
}

// Validation du mot de passe et de sa confirmation
function validatePassword() {
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('password_confirmation');
    if (!passwordField || !confirmField) return;

    function validateFields() {
        const password = passwordField.value;
        const confirm = confirmField.value;
        
        if (password.length >= 6) {
            toggleValidationIcons(passwordField, true);
        } else {
            toggleValidationIcons(passwordField, false);
        }
        
        if (password === confirm && confirm !== '') {
            toggleValidationIcons(confirmField, true);
        } else {
            toggleValidationIcons(confirmField, false);
        }
    }

    passwordField.addEventListener('input', validateFields);
    confirmField.addEventListener('input', validateFields);
}

// Fonctions utilitaires pour la validation
function toggleValidationIcons(element, isValid) {
    element.classList.toggle('valid-border', isValid);
    element.classList.toggle('invalid-border', !isValid);
    
    const validIcon = element.parentElement.querySelector('.valid-icon');
    const invalidIcon = element.parentElement.querySelector('.invalid-icon');
    
    if (validIcon && invalidIcon) {
        validIcon.style.opacity = isValid ? '1' : '0';
        invalidIcon.style.opacity = isValid ? '0' : '1';
    }
}

function toggleHelpText(elementId, show) {
    const helpText = document.getElementById(elementId);
    if (helpText) {
        helpText.style.display = show ? 'block' : 'none';
    }
}

// 2. Animations et effets
// =====================

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

// 3. Navigation
// ===========

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

// Gestion des animations de formulaire
function setupFormAnimations() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Récupération des éléments
            const submitBtn = this.querySelector('.submit-btn');
            const formBox = this.closest('.form-box');
            const inputs = this.querySelectorAll('.input-group');
            
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
                // Simulation de la validation/soumission
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Animation de succès
                submitBtn.classList.remove('loading');
                submitBtn.classList.add('success');
                
                // Réinitialisation des animations des champs
                inputs.forEach(input => {
                    input.style.animation = '';
                });
                
                // Attente de la fin de l'animation de succès
                await new Promise(resolve => setTimeout(resolve, 1000));
                
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

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Validation des formulaires
    validateLoginField();
    validateEmail();
    validateStudentCode();
    validatePassword();
    
    // Animations et effets
    setupFormFieldAnimations();
    setupFormAnimations();
    
    // Navigation
    setupNavbarScroll();

    // Password matching validation
    $('#password, #password_confirmation').on('input', function() {
        const password = $('#password').val();
        const confirm = $('#password_confirmation').val();
        const $feedback = $('#password-match-feedback');

        if (password.length > 0 && confirm.length > 0) {
            if (password !== confirm) {
                $feedback.html('<i class="bi bi-x-circle"></i> Les mots de passe ne correspondent pas')
                          .removeClass('text-success').addClass('text-danger');
            } else {
                $feedback.html('<i class="bi bi-check-circle"></i> Les mots de passe correspondent')
                          .removeClass('text-danger').addClass('text-success');
            }
        } else {
            $feedback.html('');
        }
    });

    // Email validation
    $('#email').on('input', function() {
        const email = $(this).val();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const $feedback = $('#email-feedback');

        if (email.length > 0) {
            if (!regex.test(email)) {
                $feedback.html('<i class="bi bi-x-circle"></i> Format email invalide')
                          .removeClass('text-success').addClass('text-danger');
            } else {
                $feedback.html('<i class="bi bi-check-circle"></i> Format valide')
                          .removeClass('text-danger').addClass('text-success');
            }
        } else {
            $feedback.html('');
        }
    });

    // Email availability check
    $('#email').on('input', function() {
        clearTimeout(emailCheckTimeout);
        const email = $(this).val();
        const $feedback = $('#email-availability');

        emailCheckTimeout = setTimeout(() => {
            if (email.length > 3 && $('#email-feedback').hasClass('text-success')) {
                $.ajax({
                    url: '/check-email',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        email: email
                    },
                    success: function(response) {
                        const message = response.available ? 
                            '<i class="bi bi-check-circle"></i> Email disponible' : 
                            '<i class="bi bi-x-circle"></i> Email déjà utilisé';
                        $feedback.html(message)
                                  .toggleClass('text-success text-danger', response.available);
                    }
                });
            }
        }, debounceDelay);
    });

    // Form submission handler
    $('form').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);
        const $submitBtn = $form.find('button[type="submit"]');
        const originalBtnText = $submitBtn.html();

        // Show loading state
        $submitBtn.prop('disabled', true)
                 .html('<span class="spinner-border spinner-border-sm" role="status"></span> Envoi...');

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                showFlashMessage('success', response.message);
                $form.trigger('reset');
                $('.invalid-feedback').html(''); // Clear error messages
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function(field, messages) {
                    $(`#${field}-feedback`).html(messages[0])
                                          .addClass('text-danger');
                });
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    });
});

// Flash message helper
function showFlashMessage(type, message) {
    const $alert = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('#messages-container').html($alert);
    setTimeout(() => $alert.alert('close'), 5000);
}