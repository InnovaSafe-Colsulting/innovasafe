// Services page scripts
document.addEventListener('DOMContentLoaded', function () {
    const modalServiceInfo = document.getElementById('modal-service-info');
    const modalServiceInfoOverlay = document.getElementById('modal-service-info-overlay');
    const modalServiceInfoClose = document.getElementById('modal-service-info-close');
    const btnsServiceInfo = document.querySelectorAll('.btn-service-info');

    if (!modalServiceInfo) return;

    function openServiceInfoModal(e) {
        e.preventDefault();
        modalServiceInfo.classList.remove('hidden');
        modalServiceInfo.classList.add('flex');
    }

    function closeServiceInfoModal() {
        modalServiceInfo.classList.add('hidden');
        modalServiceInfo.classList.remove('flex');
    }

    btnsServiceInfo.forEach(function (btn) {
        btn.addEventListener('click', openServiceInfoModal);
    });

    if (modalServiceInfoClose) modalServiceInfoClose.addEventListener('click', closeServiceInfoModal);
    if (modalServiceInfoOverlay) modalServiceInfoOverlay.addEventListener('click', closeServiceInfoModal);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeServiceInfoModal();
    });

    // Form submit
    const formServiceInfo = document.getElementById('form-service-info');
    if (formServiceInfo) {
        formServiceInfo.addEventListener('submit', function (e) {
            e.preventDefault();

            document.querySelectorAll('[data-service-info-error]').forEach(function (span) {
                span.classList.add('hidden');
                span.textContent = '';
            });

            const formData = new FormData(formServiceInfo);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/solicitar-informacion-servicio', {
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
                if (result.status === 200 && result.data.success) {
                    closeServiceInfoModal();
                    showToast(result.data.message, 'success');
                    showToast('Revisa tu bandeja de entrada, spam, promociones u otras carpetas para encontrar nuestro correo.', 'warning', 5000);
                    formServiceInfo.reset();
                } else if (result.status === 422) {
                    const errors = result.data.errors;
                    Object.keys(errors).forEach(function (field) {
                        const span = document.querySelector('[data-service-info-error="' + field + '"]');
                        if (span) {
                            span.textContent = errors[field][0];
                            span.classList.remove('hidden');
                        }
                    });
                } else {
                    closeServiceInfoModal();
                    showToast(result.data.message || 'Ocurrió un error. Intenta nuevamente.', 'danger');
                }
            })
            .catch(function () {
                showToast('No se pudo conectar con el servidor. Intenta nuevamente.', 'danger');
            });
        });
    }
});
