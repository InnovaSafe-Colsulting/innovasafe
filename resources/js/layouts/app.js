// Toast Notification System
const toastIcons = {
    success: '<svg class="toast-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    warning: '<svg class="toast-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
    danger: '<svg class="toast-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
};

window.showToast = function (message, type = 'success', duration = 4000) {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        ${toastIcons[type] || toastIcons.success}
        <span>${message}</span>
        <svg class="toast-icon toast-close" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    `;

    container.appendChild(toast);

    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', function () {
        removeToast(toast);
    });

    setTimeout(function () {
        removeToast(toast);
    }, duration);
};

function removeToast(toast) {
    if (toast.classList.contains('removing')) return;
    toast.classList.add('removing');
    setTimeout(function () {
        toast.remove();
    }, 300);
}

// Alert Modal System
const alertIcons = {
    error: '<div style="background-color:#fef2f2;" class="w-14 h-14 rounded-full flex items-center justify-center"><svg class="w-7 h-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></div>',
    warning: '<div style="background-color:#fffbeb;" class="w-14 h-14 rounded-full flex items-center justify-center"><svg class="w-7 h-7 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>',
    success: '<div style="background-color:#f0fdf4;" class="w-14 h-14 rounded-full flex items-center justify-center"><svg class="w-7 h-7 text-[#39bf24]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>',
    info: '<div style="background-color:#eff6ff;" class="w-14 h-14 rounded-full flex items-center justify-center"><svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>'
};

window.showAlert = function (message, type = 'error') {
    const modal = document.getElementById('alertModal');
    const iconContainer = document.getElementById('alert-icon-container');
    const messageEl = document.getElementById('alert-message');
    if (!modal) return;

    iconContainer.innerHTML = alertIcons[type] || alertIcons.error;
    messageEl.textContent = message;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
};

window.closeAlertModal = function () {
    const modal = document.getElementById('alertModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
};

document.addEventListener('DOMContentLoaded', function () {
    // Verificar si debe abrir modal de login por falta de planes
    if (window.location.hash === '#login-required') {
        const modalLogin = document.getElementById('modal-login');
        if (modalLogin) {
            modalLogin.classList.remove('hidden');
            modalLogin.classList.add('flex');
        }
        // Limpiar el hash del URL
        history.replaceState(null, null, window.location.pathname);
    }

    // Set active nav link based on current URL (ejecutar primero)
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(function(link) {
        const linkHref = link.getAttribute('href');
        // Get the path from the href (handle both relative and absolute URLs)
        let linkPath = linkHref;
        if (linkHref && linkHref.startsWith('http')) {
            // Extract path from absolute URL
            const url = new URL(linkHref);
            linkPath = url.pathname;
        }
        
        // Check if link matches current path (handle exact match and child routes)
        if (linkPath) {
            // Special case for home route '/'
            if (linkPath === '/' && currentPath === '/') {
                link.classList.add('active');
            } else if (linkPath !== '/' && (currentPath === linkPath || currentPath.startsWith(linkPath + '/'))) {
                link.classList.add('active');
            }
        }
    });

    // Set active mobile menu link
    const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
    mobileMenuLinks.forEach(function(link) {
        const linkHref = link.getAttribute('href');
        let linkPath = linkHref;
        if (linkHref && linkHref.startsWith('http')) {
            const url = new URL(linkHref);
            linkPath = url.pathname;
        }
        
        if (linkPath) {
            // Special case for home route '/'
            if (linkPath === '/' && currentPath === '/') {
                link.classList.add('active');
            } else if (linkPath !== '/' && (currentPath === linkPath || currentPath.startsWith(linkPath + '/'))) {
                link.classList.add('active');
            }
        }
    });

    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', function () {
            menu.classList.toggle('hidden');
        });
    }

    // Navbar scroll effect
    const nav = document.querySelector('nav');
    const footer = document.querySelector('footer');

    if (nav) {
        window.addEventListener('scroll', function () {
            const heroSection = document.querySelector('section');
            const heroHeight = heroSection ? heroSection.offsetHeight : 500;
            const scrollY = window.scrollY;
            const footerTop = footer ? footer.offsetTop - window.innerHeight : Infinity;

            if (scrollY > heroHeight && scrollY < footerTop) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        });
    }

    // Modal Solicitar Renovación
    const modalRenovar = document.getElementById('modal-renovar');
    const modalRenovarOverlay = document.getElementById('modal-renovar-overlay');
    const modalRenovarClose = document.getElementById('modal-renovar-close');
    const btnsRenovar = document.querySelectorAll('.btn-renovar');

    function openRenovarModal(e) {
        e.preventDefault();
        if (modalRenovar) {
            modalRenovar.classList.remove('hidden');
            modalRenovar.classList.add('flex');
        }
    }

    function closeRenovarModal() {
        if (modalRenovar) {
            modalRenovar.classList.add('hidden');
            modalRenovar.classList.remove('flex');
            
            // Reset del modal al cerrarlo
            const emailInput = document.getElementById('email-input');
            
            if (emailInput) {
                emailInput.value = '';
                emailInput.dataset.validated = 'false';
                emailInput.classList.remove('bg-green-50', 'border-green-300');
            }
            
            hideAllSections();
        }
    }

    // Hacer las funciones globales
    window.openRenovarModal = openRenovarModal;
    window.closeRenovarModal = closeRenovarModal;

    btnsRenovar.forEach(function (btn) {
        btn.addEventListener('click', openRenovarModal);
    });

    if (modalRenovarClose) modalRenovarClose.addEventListener('click', closeRenovarModal);
    if (modalRenovarOverlay) modalRenovarOverlay.addEventListener('click', closeRenovarModal);

    // Form submit del modal renovar
    const formRenovar = document.getElementById('form-renovar');
    if (formRenovar) {
        // Validar email con evento blur
        const emailInput = formRenovar.querySelector('#email-input');
        
        if (emailInput) {
            // Reset del flag cuando el usuario empiece a escribir
            emailInput.addEventListener('input', function() {
                this.dataset.validated = 'false';
                this.classList.remove('bg-green-50', 'border-green-300');
                hideAllSections(); // Limpiar secciones anteriores
            });
            
            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                
                if (!email) {
                    return;
                }
                
                if (!this.validity.valid) {
                    showToast('Por favor ingresa un correo electrónico válido', 'warning');
                    return;
                }
                
                // Verificar si ya fue validado
                if (this.dataset.validated === 'true') {
                    return;
                }
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                fetch('/validar-email-renovar', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Limpiar todo antes de mostrar el nuevo estado
                        hideAllSections();
                        
                        if (data.hasPendingOrders) {
                            showPendingOrdersForm(data.availableServices);
                        } else if (data.userExists && data.hasServices && data.services.length > 0) {
                            showUserServices(data.services);
                        } else {
                            showNoServicesForm();
                        }
                        
                        // Marcar como validado
                        this.dataset.validated = 'true';
                        this.classList.add('bg-green-50', 'border-green-300');
                    } else {
                        hideAllSections();
                        showToast('Error al validar el correo', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error validating email:', error);
                    hideAllSections();
                    showToast('Error de conexión', 'danger');
                });
            });
        }
        
        formRenovar.addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Verificar si está en modo renovación, nuevo cliente o comprar más
            const userServicesDiv = document.getElementById('user-services');
            const noServicesDiv = document.getElementById('no-services');
            const pendingOrdersDiv = document.getElementById('pending-orders');
            const buyMoreForm = document.getElementById('buy-more-form');
            
            // Validación manual según la sección visible
            let isValid = true;
            const emailInput = formRenovar.querySelector('#email-input');
            
            // Siempre validar email
            if (!emailInput.value.trim() || !emailInput.validity.valid) {
                showToast('Por favor ingresa un correo electrónico válido', 'warning');
                emailInput.focus();
                return;
            }
            
            // Validar campos específicos según la sección visible
            if (!noServicesDiv.classList.contains('hidden')) {
                // Validar formulario nuevo cliente
                const nombreInput = formRenovar.querySelector('input[name="nombre_nuevo"]');
                const telefonoInput = formRenovar.querySelector('input[name="telefono_nuevo"]');
                
                if (!nombreInput.value.trim()) {
                    showToast('Por favor ingresa tu nombre completo', 'warning');
                    nombreInput.focus();
                    return;
                }
                
                if (!telefonoInput.value.trim()) {
                    showToast('Por favor ingresa tu teléfono', 'warning');
                    telefonoInput.focus();
                    return;
                }
            } else if (!pendingOrdersDiv.classList.contains('hidden') && !buyMoreForm.classList.contains('hidden')) {
                // Validar formulario comprar más
                const nombreMasInput = formRenovar.querySelector('input[name="nombre_mas"]');
                const telefonoMasInput = formRenovar.querySelector('input[name="telefono_mas"]');
                const servicioSelect = formRenovar.querySelector('select[name="servicio_adicional"]');
                
                if (!nombreMasInput.value.trim()) {
                    showToast('Por favor ingresa tu nombre completo', 'warning');
                    nombreMasInput.focus();
                    return;
                }
                
                if (!telefonoMasInput.value.trim()) {
                    showToast('Por favor ingresa tu teléfono', 'warning');
                    telefonoMasInput.focus();
                    return;
                }
                
                if (!servicioSelect.value) {
                    showToast('Por favor selecciona un servicio', 'warning');
                    servicioSelect.focus();
                    return;
                }
            }
            
            // Obtener FormData después de validación exitosa
            const formData = new FormData(formRenovar);
            
            if (!userServicesDiv.classList.contains('hidden')) {
                // Modo renovación
                closeRenovarModal();
                showToast('Solicitud de renovación enviada correctamente', 'success');
            } else if (!noServicesDiv.classList.contains('hidden')) {
                // Modo nuevo cliente - enviar email
                sendNewClientEmail(formData);
            } else if (!pendingOrdersDiv.classList.contains('hidden') && !buyMoreForm.classList.contains('hidden')) {
                // Modo comprar más servicios
                sendNewClientEmail(formData, 'Solicitud de servicios adicionales - Cliente con pago pendiente');
            }
        });
    }
    
    function showUserServices(services) {
        const userServicesDiv = document.getElementById('user-services');
        const servicesList = document.getElementById('services-list');
        
        if (userServicesDiv && servicesList) {
            servicesList.innerHTML = '';
            services.forEach(service => {
                const serviceItem = document.createElement('div');
                serviceItem.className = 'bg-gray-50 p-3 rounded-lg';
                serviceItem.innerHTML = `
                    <p class="font-medium text-gray-900">${service.name}</p>
                    <p class="text-sm text-gray-600">${service.type} - ${service.billing_period}</p>
                `;
                servicesList.appendChild(serviceItem);
            });
            userServicesDiv.classList.remove('hidden');
        }
    }
    
    function showNoServicesForm() {
        const noServicesDiv = document.getElementById('no-services');
        if (noServicesDiv) {
            noServicesDiv.classList.remove('hidden');
        }
        hideUserServices();
    }
    
    function hideUserServices() {
        const userServicesDiv = document.getElementById('user-services');
        if (userServicesDiv) {
            userServicesDiv.classList.add('hidden');
        }
    }
    
    function hideAllSections() {
        hideUserServices();
        const noServicesDiv = document.getElementById('no-services');
        const pendingOrdersDiv = document.getElementById('pending-orders');
        const buyMoreForm = document.getElementById('buy-more-form');
        
        if (noServicesDiv) {
            noServicesDiv.classList.add('hidden');
        }
        if (pendingOrdersDiv) {
            pendingOrdersDiv.classList.add('hidden');
        }
        if (buyMoreForm) {
            buyMoreForm.classList.add('hidden');
        }
        
        // Limpiar radio buttons de pending orders
        const radioButtons = document.querySelectorAll('input[name="comprar_mas"]');
        radioButtons.forEach(radio => radio.checked = false);
        
        // Limpiar lista de servicios
        const servicesList = document.getElementById('services-list');
        if (servicesList) {
            servicesList.innerHTML = '';
        }
        
        // Resetear radio buttons de renovar servicios
        const renovarRadios = document.querySelectorAll('input[name="renovar_servicios"]');
        renovarRadios.forEach(radio => radio.checked = false);
    }
    
    function sendNewClientEmail(formData, customMessage = null) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        if (customMessage) {
            formData.append('custom_message', customMessage);
        }
        
        fetch('/solicitar-nuevo-cliente', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            return response.json().then(data => {
                return { status: response.status, data: data };
            });
        })
        .then(result => {
            if (result.status === 201 && result.data.success) {
                closeRenovarModal();
                showToast(result.data.message, 'success');
                // Reset del formulario después del éxito
                const formRenovar = document.getElementById('form-renovar');
                if (formRenovar) {
                    formRenovar.reset();
                    const emailInput = document.getElementById('email-input');
                    if (emailInput) {
                        emailInput.dataset.validated = 'false';
                        emailInput.classList.remove('bg-green-50', 'border-green-300');
                    }
                }
                hideAllSections();
            } else if (result.status === 422) {
                // Error de validación
                console.log('Validation errors:', result.data.errors);
                showToast('Error de validación: ' + (result.data.message || 'Revisa los datos ingresados'), 'danger');
            } else {
                console.log('Server error:', result.data);
                showToast(result.data.message || 'Error al enviar solicitud', 'danger');
            }
        })
        .catch(error => {
            console.error('Network error:', error);
            showToast('Error de conexión', 'danger');
        });
    }
    
    function showPendingOrdersForm(availableServices = []) {
        const pendingOrdersDiv = document.getElementById('pending-orders');
        if (pendingOrdersDiv) {
            pendingOrdersDiv.classList.remove('hidden');
            
            // Llenar el select de servicios
            const serviceSelect = pendingOrdersDiv.querySelector('select[name="servicio_adicional"]');
            if (serviceSelect && availableServices.length > 0) {
                // Limpiar opciones existentes excepto la primera
                const firstOption = serviceSelect.querySelector('option[value=""]');
                serviceSelect.innerHTML = '';
                serviceSelect.appendChild(firstOption);
                
                // Agregar servicios
                availableServices.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.id;
                    option.textContent = service.name;
                    if (service.description) {
                        option.title = service.description; // Tooltip con descripción
                    }
                    serviceSelect.appendChild(option);
                });
            }
        }
        hideUserServices();
        hideNoServicesForm();
    }
    
    function hideNoServicesForm() {
        const noServicesDiv = document.getElementById('no-services');
        if (noServicesDiv) {
            noServicesDiv.classList.add('hidden');
        }
    }
    
    // Funciones globales para radio buttons
    window.showBuyMoreForm = function() {
        const buyMoreForm = document.getElementById('buy-more-form');
        if (buyMoreForm) {
            buyMoreForm.classList.remove('hidden');
        }
    };
    
    window.closeModalOnNo = function() {
        closeRenovarModal();
    };

    // Modal Solicitar Asesoría
    const modal = document.getElementById('modal-asesoria');
    const modalOverlay = document.getElementById('modal-overlay');
    const modalClose = document.getElementById('modal-close');
    const btnsAsesoria = document.querySelectorAll('.btn-asesoria');

    function openModal(e) {
        e.preventDefault();
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    btnsAsesoria.forEach(function (btn) {
        btn.addEventListener('click', openModal);
    });

    if (modalClose) modalClose.addEventListener('click', closeModal);
    if (modalOverlay) modalOverlay.addEventListener('click', closeModal);

    // Form submit del modal asesoría
    const formAsesoria = document.getElementById('form-asesoria');
    if (formAsesoria) {
        formAsesoria.addEventListener('submit', function (e) {
            e.preventDefault();

            document.querySelectorAll('[data-error]').forEach(function (span) {
                span.classList.add('hidden');
                span.textContent = '';
            });

            const siteKey = document.querySelector('meta[name="recaptcha-site-key"]').getAttribute('content');

            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, { action: 'advisory' }).then(function (token) {
                    const formData = new FormData(formAsesoria);
                    formData.append('recaptcha_token', token);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('/solicitar-asesoria', {
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
                            closeModal();
                            showToast(result.data.message, 'success');
                            formAsesoria.reset();
                        } else if (result.status === 422) {
                            const errors = result.data.errors;
                            Object.keys(errors).forEach(function (field) {
                                const span = document.querySelector('[data-error="' + field + '"]');
                                if (span) {
                                    span.textContent = errors[field][0];
                                    span.classList.remove('hidden');
                                }
                            });
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
    }

    // Modal Login
    const modalLogin = document.getElementById('modal-login');
    const modalLoginOverlay = document.getElementById('modal-login-overlay');
    const modalLoginClose = document.getElementById('modal-login-close');
    const btnsLogin = document.querySelectorAll('.btn-login');

    function openLoginModal(e) {
        e.preventDefault();
        modalLogin.classList.remove('hidden');
        modalLogin.classList.add('flex');
    }

    function closeLoginModal() {
        modalLogin.classList.add('hidden');
        modalLogin.classList.remove('flex');
    }

    btnsLogin.forEach(function (btn) {
        btn.addEventListener('click', openLoginModal);
    });

    if (modalLoginClose) modalLoginClose.addEventListener('click', closeLoginModal);
    if (modalLoginOverlay) modalLoginOverlay.addEventListener('click', closeLoginModal);

    // Modal de Servicios
    const servicesModal = document.getElementById('servicesModal');

    window.openServicesModal = function() {
        if (!servicesModal) return;
        servicesModal.classList.remove('hidden');
        servicesModal.classList.add('flex');
    };

    window.closeServicesModal = function() {
        if (!servicesModal) return;
        servicesModal.classList.add('hidden');
        servicesModal.classList.remove('flex');
    };

    window.submitServiceSelection = function() {
        const selectedService = document.querySelector('input[name="service_id"]:checked');
        
        if (!selectedService) {
            showToast('Por favor selecciona un servicio', 'warning');
            return;
        }
        
        // Verificar si el servicio seleccionado está en construcción
        const serviceLabel = selectedService.closest('label');
        if (serviceLabel && serviceLabel.querySelector('.bg-yellow-100')) {
            showToast('Este servicio aún está en construcción', 'warning');
            return;
        }
        
        closeServicesModal();
        showToast('Servicio seleccionado', 'success');
    };

    // Modal Solicitar Información Servicios
    const modalServiceInfo = document.getElementById('modal-service-info');
    const modalServiceInfoOverlay = document.getElementById('modal-service-info-overlay');
    const modalServiceInfoClose = document.getElementById('modal-service-info-close');
    const btnsServiceInfo = document.querySelectorAll('.btn-service-info');
    const formServiceInfo = document.getElementById('form-service-info');

    function openServiceInfoModal(e) {
        e.preventDefault();
        if (modalServiceInfo) {
            modalServiceInfo.classList.remove('hidden');
            modalServiceInfo.classList.add('flex');
        }
    }

    function closeServiceInfoModal() {
        if (!modalServiceInfo) return;
        modalServiceInfo.classList.add('hidden');
        modalServiceInfo.classList.remove('flex');
    }

    btnsServiceInfo.forEach(function(btn) {
        btn.addEventListener('click', openServiceInfoModal);
    });

    if (modalServiceInfoClose) modalServiceInfoClose.addEventListener('click', closeServiceInfoModal);
    if (modalServiceInfoOverlay) modalServiceInfoOverlay.addEventListener('click', closeServiceInfoModal);

    // Form submit del modal service info
    if (formServiceInfo) {
        formServiceInfo.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = formServiceInfo.querySelector('button[type="submit"]');
            
            // Deshabilitar botón para evitar múltiples envíos
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enviando...';
            }

            document.querySelectorAll('[data-service-info-error]').forEach(function(span) {
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
            .then(function(response) {
                return response.json().then(function(data) {
                    return { status: response.status, data: data };
                });
            })
            .then(function(result) {
                if (result.status === 200) {
                    closeServiceInfoModal();
                    showToast(result.data.message, 'success');
                    formServiceInfo.reset();
                } else if (result.status === 422) {
                    const errors = result.data.errors;
                    Object.keys(errors).forEach(function(field) {
                        const span = document.querySelector('[data-service-info-error="' + field + '"]');
                        if (span) {
                            span.textContent = errors[field][0];
                            span.classList.remove('hidden');
                        }
                    });
                } else {
                    showToast(result.data.message || 'Ocurrió un error. Intenta nuevamente.', 'danger');
                }
            })
            .catch(function() {
                showToast('No se pudo conectar con el servidor. Intenta nuevamente.', 'danger');
            })
            .finally(function() {
                // Reactivar botón después de la respuesta
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Enviar';
                }
            });
        });
    }

    // Modal Video
    const videoModal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');

    window.openVideoModalDynamic = function(videoUrl) {
        if (!videoModal || !videoFrame) return;
        
        // Si la URL no empieza con / o http, agregar / al inicio
        if (!videoUrl.startsWith('/') && !videoUrl.startsWith('http')) {
            videoUrl = '/' + videoUrl;
        }
        
        videoFrame.src = videoUrl;
        videoFrame.play().catch(function(error) {
            console.log('Error al reproducir:', error);
        });
        
        videoModal.classList.remove('hidden');
        videoModal.classList.add('flex');
    };

    window.closeVideoModal = function() {
        if (!videoModal || !videoFrame) return;
        
        videoFrame.pause();
        videoFrame.src = '';
        videoModal.classList.add('hidden');
        videoModal.classList.remove('flex');
    };

    window.openVideoModalFunciona = function() {
        const videoUrl = '/videos/SST.mp4';
        if (!videoModal || !videoFrame) return;
        
        videoFrame.src = videoUrl;
        videoFrame.play().catch(function(error) {
            console.log('Error al reproducir:', error);
        });
        
        videoModal.classList.remove('hidden');
        videoModal.classList.add('flex');
    };

    // Cerrar modal con Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeDemoModal();
            closeRenovarModal();
            closeLoginModal();
            closeServicesModal();
            closeVideoModal();
        }
    });

    // Form submit del modal login
    const formLogin = document.getElementById('form-login');
    if (formLogin) {
        formLogin.addEventListener('submit', function (e) {
            e.preventDefault();

            // Limpiar errores previos
            document.querySelectorAll('[data-login-error]').forEach(function (span) {
                span.classList.add('hidden');
                span.textContent = '';
            });

            // ── Bloquear botón y mostrar spinner ──────────────────────────
            const submitBtn = formLogin.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <span style="display:inline-flex;align-items:center;justify-content:center;gap:.5rem;">
                    <svg style="width:1.1rem;height:1.1rem;animation:spin .8s linear infinite" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                    </svg>
                    Verificando...
                </span>`;

            function restoreBtn() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            }
            // ──────────────────────────────────────────────────────────────

            const formData = new FormData(formLogin);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/login', {
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
                    closeLoginModal();
                    showToast('Ingreso exitoso', 'success');
                    setTimeout(function() {
                        window.location.href = result.data.redirect;
                    }, 500);
                } else if (result.status === 422) {
                    restoreBtn();
                    const errors = result.data.errors;
                    Object.keys(errors).forEach(function (field) {
                        const span = document.querySelector('[data-login-error="' + field + '"]');
                        if (span) {
                            span.textContent = errors[field][0];
                            span.classList.remove('hidden');
                        }
                    });
                } else if (result.status === 401 || result.status === 403) {
                    restoreBtn();
                    closeLoginModal();
                    showToast(result.data.message, 'danger');
                } else {
                    restoreBtn();
                    showToast('Ocurrió un error. Intenta nuevamente.', 'danger');
                }
            })
            .catch(function () {
                restoreBtn();
                showToast('No se pudo conectar con el servidor. Intenta nuevamente.', 'danger');
            });
        });
    }
});