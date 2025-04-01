/**
 * CAMPUS ELECT - Scripts de validation d'authentification
 * ======================================
 */

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
        
        const isPasswordValid = password.length >= 6;
        const isConfirmValid = password === confirm && confirm !== '';
        
        toggleValidationIcons(passwordField, isPasswordValid);
        toggleValidationIcons(confirmField, isConfirmValid);
        
        toggleHelpText('passwordHelp', !isPasswordValid);
        toggleHelpText('confirmHelp', !isConfirmValid && confirm !== '');
    }

    passwordField.addEventListener('input', validateFields);
    confirmField.addEventListener('input', validateFields);
    
    // Afficher/masquer les messages d'aide au focus/blur
    passwordField.addEventListener('focus', () => toggleHelpText('passwordHelp', true));
    passwordField.addEventListener('blur', () => {
        if (passwordField.value.length >= 6) {
            toggleHelpText('passwordHelp', false);
        }
    });
    
    confirmField.addEventListener('focus', () => toggleHelpText('confirmHelp', true));
    confirmField.addEventListener('blur', () => {
        if (confirmField.value === passwordField.value && confirmField.value !== '') {
            toggleHelpText('confirmHelp', false);
        }
    });
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

// Initialisation des validations
function initValidation() {
    // Validation des formulaires
    validateLoginField();
    validateEmail();
    validateStudentCode();
    validatePassword();

    // Validation jQuery pour les mots de passe correspondants
    if (typeof $ !== 'undefined') {
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

        // Validation jQuery pour l'email
        $('#email').on('input', function() {
            const email = $(this).val();
            const regex = /^[^\s@]+@ugb\.edu\.sn$/;
            if (email.length > 0) {
                if (regex.test(email)) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                } else {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                }
            } else {
                $(this).removeClass('is-valid is-invalid');
            }
        });
    }
}

// Exporter les fonctions pour les utiliser dans d'autres fichiers
window.authValidation = {
    init: initValidation
}; 