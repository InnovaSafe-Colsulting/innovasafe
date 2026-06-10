// Contact page scripts
document.addEventListener('DOMContentLoaded', function () {
    const formContact = document.getElementById('form-contact');
    if (!formContact) return;

    formContact.addEventListener('submit', function (e) {
        e.preventDefault();

        document.querySelectorAll('[data-contact-error]').forEach(function (span) {
            span.classList.add('hidden');
            span.textContent = '';
        });

        const siteKey = document.querySelector('meta[name="recaptcha-site-key"]').getAttribute('content');

        grecaptcha.ready(function () {
            grecaptcha.execute(siteKey, { action: 'contact' }).then(function (token) {
                const formData = new FormData(formContact);
                formData.append('recaptcha_token', token);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/contacto', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return { status: response.status, data: data };
                    });
                })
                .then(function (result) {
                    if (result.status === 201) {
                        showToast(result.data.message, 'success');
                        formContact.reset();
                    } else if (result.status === 422) {
                        const errors = result.data.errors;
                        Object.keys(errors).forEach(function (field) {
                            const span = document.querySelector('[data-contact-error="' + field + '"]');
                            if (span) {
                                span.textContent = errors[field][0];
                                span.classList.remove('hidden');
                            }
                        });
                        showToast('Por favor corrige los campos señalados.', 'warning');
                    } else {
                        showToast(result.data.message || 'Ocurrió un error. Intenta nuevamente.', 'danger');
                    }
                })
                .catch(function () {
                    showToast('No se pudo conectar con el servidor. Intenta nuevamente.', 'danger');
                });
            });
        });
    });
});
