// Contact page scripts
document.addEventListener('DOMContentLoaded', function () {
    const formContact = document.getElementById('form-contact');
    if (!formContact) return;

    formContact.addEventListener('submit', function (e) {
        e.preventDefault();

        // Aplicar cursor de pensando/cargando
        const submitBtn = formContact.querySelector('button[type="submit"]');
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.classList.add('cursor-thinking');
        document.body.classList.add('cursor-thinking');
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
            </svg>
            Enviando...
        `;

        function restoreBtn() {
            submitBtn.disabled = false;
            submitBtn.classList.remove('cursor-thinking');
            document.body.classList.remove('cursor-thinking');
            submitBtn.innerHTML = originalBtnHtml;
        }

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
                        restoreBtn();
                        showToast(result.data.message, 'success');
                        formContact.reset();
                    } else if (result.status === 422) {
                        restoreBtn();
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
                        restoreBtn();
                        showToast(result.data.message || 'Ocurrió un error. Intenta nuevamente.', 'danger');
                    }
                })
                .catch(function () {
                    restoreBtn();
                    showToast('No se pudo conectar con el servidor. Intenta nuevamente.', 'danger');
                });
            });
        });
    });
});
