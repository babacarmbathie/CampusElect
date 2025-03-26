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

// Flash message helper
function showFlashMessage(type, message) {
    const $alert = $(`
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);
    
    $('#messages-container').html($alert);
    setTimeout(() => $alert.alert('close'), 5000);
}