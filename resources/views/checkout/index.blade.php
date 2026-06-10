@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
<div class="pt-20 min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 py-8">
        
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Finalizar Compra</h1>
                <div class="text-right">
                    <p id="checkout-grand-total" class="text-2xl font-black text-[#0a0f2c]">${{ number_format($grandTotal) }}</p>
                    <p class="text-sm font-semibold text-gray-500">COP</p>
                </div>
            </div>
        </div>

        <!-- Búsqueda de Productos -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Agregar más productos</h2>
                <button id="toggleSearchBtn" class="bg-[#2268bd] hover:bg-[#1a4c8c] text-white px-4 py-2 rounded-lg transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar Productos
                </button>
            </div>
            
            <!-- Panel de búsqueda (oculto por defecto) -->
            <div id="searchPanel" class="hidden border-t border-gray-200 pt-4">
                <div class="flex gap-4 mb-4">
                    <input type="text" id="productSearch" placeholder="Buscar planes..." 
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" onclick="searchProducts()" 
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg transition-colors">
                        Buscar
                    </button>
                </div>
                
                <!-- Resultados de búsqueda -->
                <div id="searchResults" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Se llenarán dinámicamente -->
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Resumen del Pedido -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Resumen del Pedido</h2>
                    
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                        <div id="checkout-item-{{ $item['id'] }}" class="flex items-center gap-4 p-4 border border-gray-100 rounded-lg">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <img src="{{ asset('images/products/' . $item['image']) }}" 
                                     alt="{{ $item['name'] }}" 
                                     class="w-full h-full rounded-lg object-cover"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs" style="display:none;">
                                    PLAN
                                </div>
                            </div>
                            
                            <!-- Cantidad editable -->
                            <div class="flex items-center">
                                <div class="flex items-center border border-gray-200 rounded">
                                    <button onclick="decreaseCheckoutQuantity({{ $item['id'] }})" 
                                            class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 {{ $item['quantity'] <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <span id="checkout-quantity-{{ $item['id'] }}" class="px-4 py-2 text-sm font-medium text-gray-700 min-w-[3rem] text-center">{{ $item['quantity'] }}</span>
                                    <button onclick="increaseCheckoutQuantity({{ $item['id'] }})" class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $item['description'] }}</p>
                                <p class="text-xs text-gray-500">Precio unitario: ${{ number_format($item['unit_price']) }}</p>
                            </div>
                            
                            <div class="text-right">
                                <p id="checkout-total-{{ $item['id'] }}" class="font-bold text-gray-900">${{ number_format($item['total']) }}</p>
                                <p class="text-xs text-gray-500">COP</p>
                            </div>
                            
                            <!-- Botón eliminar -->
                            <div>
                                <button onclick="removeCheckoutItem({{ $item['id'] }})" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar producto">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Forma de Pago -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Forma de Pago</h2>
                    
                    <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $grandTotal }}">
                        
                        <!-- Selector de Método de Pago -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Selecciona tu método de pago:</label>
                            <div class="space-y-3">
                                @foreach($paymentTypes as $paymentType)
                                <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer {{ $paymentType->name === 'PayU' ? 'opacity-50 cursor-not-allowed' : '' }}">
                                    <input type="radio" name="payment_type_id" value="{{ $paymentType->id }}" 
                                           class="text-blue-600 focus:ring-blue-500 border-gray-300"
                                           onchange="handlePaymentTypeChange({{ $paymentType->id }}, '{{ $paymentType->name }}')"
                                           {{ $paymentType->name === 'PayU' ? 'disabled' : '' }}>
                                    <div class="ml-3 flex-1">
                                        <span class="font-medium text-gray-900">{{ $paymentType->name }}</span>
                                        @if($paymentType->name === 'PayU')
                                            <p class="text-xs text-gray-500 mt-1">Pronto tendremos esta forma de pago para tu comodidad</p>
                                        @endif
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Consignación Bancaria -->
                        <div id="bank-transfer-form" class="hidden payment-form">
                            <a id="download-payment-pdf" href="#" target="_blank"
                               class="flex items-center justify-center gap-2 w-full mb-4 px-4 py-3 bg-[#0a0f2c] hover:bg-[#141a3d] text-white font-semibold rounded-lg transition-colors text-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Descargar datos de pago (PDF)
                            </a>
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                                <p class="text-sm text-amber-800">
                                    Una vez realices el pago, envía el comprobante al correo 
                                    <strong>servicioalcliente@innovasafeconsulting.com</strong> 
                                    para verificar tu pago y comunicarnos contigo.
                                </p>
                            </div>
                        </div>

                        <!-- Nequi / Daviplata -->
                        <div id="digital-wallet-form" class="hidden payment-form">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Comprobante de Pago <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" name="payment_image" accept=".pdf,.jpeg,.jpg,.png,.webp" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <p class="text-xs text-gray-500 mt-1">Sube la captura de pantalla del pago (JPEG, JPG, PNG, WEBP o PDF)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="mt-6 space-y-3">
                            <button type="submit" id="submitBtn" 
                                    class="hidden w-full bg-[#2268bd] hover:bg-[#1a4c8c] text-white font-semibold py-3 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                Confirmar Pago
                            </button>
                            
                            <a href="{{ route('cart') }}" 
                               class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-lg transition-colors">
                                Volver al Carrito
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const paymentDetails = @json($paymentDetails);

// Toggle search panel
document.getElementById('toggleSearchBtn').addEventListener('click', function() {
    const searchPanel = document.getElementById('searchPanel');
    if (searchPanel.classList.contains('hidden')) {
        searchPanel.classList.remove('hidden');
        this.innerHTML = '<svg class="w-4 h-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>Cerrar Búsqueda';
        loadAllProducts();
    } else {
        searchPanel.classList.add('hidden');
        this.innerHTML = '<svg class="w-4 h-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Buscar Productos';
    }
});

// Load all products initially
function loadAllProducts() {
    fetch('{{ route("api.plans") }}')
    .then(response => response.json())
    .then(data => {
        displaySearchResults(data);
    })
    .catch(error => {
        console.error('Error loading products:', error);
    });
}

// Search products function
function searchProducts() {
    const query = document.getElementById('productSearch').value;
    const url = query ? `{{ route("api.plans") }}?search=${encodeURIComponent(query)}` : `{{ route("api.plans") }}`;
    
    fetch(url)
    .then(response => response.json())
    .then(data => {
        displaySearchResults(data);
    })
    .catch(error => {
        console.error('Error searching products:', error);
    });
}

// Display search results
function displaySearchResults(products) {
    const resultsContainer = document.getElementById('searchResults');
    
    if (products.length === 0) {
        resultsContainer.innerHTML = '<p class="text-gray-500 text-center col-span-full py-8">No se encontraron productos</p>';
        return;
    }
    
    resultsContainer.innerHTML = products.map(product => `
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
            <h3 class="font-semibold text-gray-900 mb-2">${product.name}</h3>
            <p class="text-sm text-gray-600 mb-3">${product.description || ''}</p>
            <div class="flex items-center justify-between mb-3">
                <span class="text-lg font-bold text-[#2268bd]">$${product.prize.toLocaleString()}</span>
                <span class="text-xs text-gray-500">Mensual</span>
            </div>
            <button onclick="addProductToCheckout(${product.id}, '${product.name}', ${product.prize})" 
                    class="w-full bg-[#2268bd] hover:bg-[#1a4c8c] text-white py-2 px-4 rounded-lg text-sm transition-colors">
                Agregar al Carrito
            </button>
        </div>
    `).join('');
}

// Add product to checkout
function addProductToCheckout(planId, productName, price) {
    const formData = new FormData();
    formData.append('plan_id', planId);
    formData.append('product_name', productName);
    formData.append('billing_period', 'Mensual');
    formData.append('price', price);
    
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Producto agregado exitosamente', 'success');
            // Reload checkout page to show new items
            window.location.reload();
        } else {
            showToast('Error al agregar producto', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error al agregar producto', 'error');
    });
}

// Checkout quantity functions
function increaseCheckoutQuantity(itemId) {
    const quantityElement = document.getElementById(`checkout-quantity-${itemId}`);
    let quantity = parseInt(quantityElement.textContent) + 1;
    updateCheckoutQuantity(itemId, quantity);
}

function decreaseCheckoutQuantity(itemId) {
    const quantityElement = document.getElementById(`checkout-quantity-${itemId}`);
    let quantity = parseInt(quantityElement.textContent);
    
    if (quantity > 1) {
        quantity -= 1;
        updateCheckoutQuantity(itemId, quantity);
    }
}

function updateCheckoutQuantity(itemId, quantity) {
    fetch(`/cart/update/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity display
            document.getElementById(`checkout-quantity-${itemId}`).textContent = quantity;
            // Update item total
            document.getElementById(`checkout-total-${itemId}`).textContent = `$${data.new_total.toLocaleString()}`;
            // Update grand total
            document.getElementById('checkout-grand-total').textContent = `$${data.grand_total.toLocaleString()}`;
            // Update form amount
            document.querySelector('input[name="amount"]').value = data.grand_total;
            
            // Handle decrease button state
            const decreaseBtn = document.querySelector(`[onclick="decreaseCheckoutQuantity(${itemId})"]`);
            if (quantity <= 1) {
                decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
                decreaseBtn.disabled = true;
            } else {
                decreaseBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                decreaseBtn.disabled = false;
            }
        } else {
            showToast('Error al actualizar cantidad', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error al actualizar cantidad', 'error');
    });
}

function removeCheckoutItem(itemId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        return;
    }
    
    fetch(`/cart/remove/${itemId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove item from DOM
            const itemElement = document.getElementById(`checkout-item-${itemId}`);
            itemElement.style.opacity = '0';
            setTimeout(() => {
                itemElement.remove();
                // Reload page if no items left
                const remainingItems = document.querySelectorAll('[id^="checkout-item-"]');
                if (remainingItems.length === 1) { // 1 because we haven't removed it yet
                    window.location.href = '{{ route("cart") }}';
                }
            }, 300);
            
            // Recalculate and update total
            recalculateCheckoutTotal();
            showToast('Producto eliminado', 'success');
        } else {
            showToast('Error al eliminar producto', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error al eliminar producto', 'error');
    });
}

function recalculateCheckoutTotal() {
    fetch('{{ route("cart.data") }}')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('checkout-grand-total').textContent = `$${data.total.toLocaleString()}`;
            document.querySelector('input[name="amount"]').value = data.total;
        }
    })
    .catch(error => {
        console.error('Error recalculating total:', error);
    });
}

function handlePaymentTypeChange(paymentTypeId, paymentTypeName) {
    // Ocultar todos los formularios
    document.querySelectorAll('.payment-form').forEach(form => {
        form.classList.add('hidden');
    });

    const submitBtn = document.getElementById('submitBtn');
    
    if (paymentTypeName === 'Consignación Bancaria') {
        document.getElementById('bank-transfer-form').classList.remove('hidden');
        const pdfLink = document.getElementById('download-payment-pdf');
        if (pdfLink) pdfLink.href = `/checkout/payment-pdf/${paymentTypeId}`;
        submitBtn.classList.add('hidden');
    } else if (['Nequi', 'Daviplata'].includes(paymentTypeName)) {
        document.getElementById('digital-wallet-form').classList.remove('hidden');
        submitBtn.classList.remove('hidden');
        submitBtn.disabled = false;
        showWalletModal(paymentTypeId, paymentTypeName);
    }
}

function showWalletModal(paymentTypeId, paymentTypeName) {
    const detail = paymentDetails[paymentTypeId];
    if (!detail) return;

    const cellphone = detail.cellphone || '';
    const holder = detail.holder || '';

    document.getElementById('wallet-modal-title').textContent = paymentTypeName;
    document.getElementById('wallet-modal-number').textContent = cellphone;
    document.getElementById('wallet-modal-holder').textContent = holder;
    document.getElementById('wallet-modal-copy-btn').setAttribute('data-number', cellphone);
    document.getElementById('walletModal').classList.remove('hidden');
    document.getElementById('walletModal').classList.add('flex');
}

function closeWalletModal() {
    document.getElementById('walletModal').classList.add('hidden');
    document.getElementById('walletModal').classList.remove('flex');
}

function copyWalletNumber() {
    const number = document.getElementById('wallet-modal-copy-btn').getAttribute('data-number');
    navigator.clipboard.writeText(number).then(function() {
        showToast('Número copiado al portapapeles', 'success');
    });
}

// Validar formulario antes de enviar
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const selectedPaymentType = document.querySelector('input[name="payment_type_id"]:checked');
    
    if (!selectedPaymentType) {
        e.preventDefault();
        showAlert('Por favor selecciona un método de pago', 'warning');
        return;
    }
    
    const paymentTypeName = selectedPaymentType.closest('label').querySelector('.font-medium').textContent.trim();
    if (['Nequi', 'Daviplata'].includes(paymentTypeName)) {
        const fileInput = document.querySelector('#digital-wallet-form input[name="payment_image"]');
        const file = fileInput.files[0];
        if (!file) {
            e.preventDefault();
            showAlert('Por favor sube el comprobante de pago', 'error');
            return;
        }
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'application/pdf'];
        if (!allowedTypes.includes(file.type)) {
            e.preventDefault();
            showAlert('El archivo debe ser una imagen (JPEG, JPG, PNG, WEBP) o un PDF', 'error');
            return;
        }
    }
});
</script>

<!-- Modal Nequi / Daviplata -->
<div id="walletModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black bg-opacity-50" role="dialog" aria-modal="true">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <h3 id="wallet-modal-title" class="text-lg font-semibold text-gray-900">Nequi</h3>
            <button onclick="closeWalletModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <p class="text-sm text-gray-500 mb-1">Número</p>
                <div class="flex items-center gap-2">
                    <span id="wallet-modal-number" class="text-xl font-bold text-gray-900"></span>
                    <button id="wallet-modal-copy-btn" data-number="" onclick="copyWalletNumber()" 
                            class="p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors" title="Copiar número">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">A nombre de</p>
                <p id="wallet-modal-holder" class="text-base font-semibold text-gray-900"></p>
            </div>
        </div>
        <div class="p-6 border-t border-gray-100">
            <button onclick="closeWalletModal()" class="w-full bg-[#2268bd] hover:bg-[#1a4c8c] text-white font-semibold py-3 rounded-lg transition-colors">
                Entendido
            </button>
        </div>
    </div>
</div>
@endsection