@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="pt-20 min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 py-8">
        
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Carrito de Compras</h1>
                <div class="text-right space-y-1">
                    <p class="text-sm text-gray-500">Subtotal: <span id="cart-subtotal" class="font-semibold text-gray-700">${{ number_format($subtotalProducts) }}</span></p>
                    <p class="text-sm text-gray-500">IVA (19%): <span id="cart-iva" class="font-semibold text-gray-700">${{ number_format($iva) }}</span></p>
                    <p class="text-2xl font-black text-[#0a0f2c]" id="cart-grand-total">${{ number_format($totalToPay) }}</p>
                    <p class="text-sm font-semibold text-gray-500">COP</p>
                </div>
            </div>
        </div>

        <!-- Cart Items -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            
            <!-- Table Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="grid grid-cols-5 gap-4 items-center">
                    <div class="text-sm font-semibold text-gray-700">Imagen</div>
                    <div class="text-sm font-semibold text-gray-700">Cantidad</div>
                    <div class="text-sm font-semibold text-gray-700">Producto</div>
                    <div class="text-sm font-semibold text-gray-700 text-center">Total</div>
                    <div class="text-sm font-semibold text-gray-700 text-center">Acciones</div>
                </div>
            </div>

            <!-- Cart Items -->
            <div class="divide-y divide-gray-200">
                        @forelse($cartItems as $item)
                        <!-- Item {{ $item->id }} -->
                        <div id="cart-item-{{ $item->id }}" class="p-6">
                            <div class="grid grid-cols-5 gap-4 items-center">
                                
                                <!-- Imagen -->
                                <div class="flex items-center justify-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs">
                                        PLAN
                                    </div>
                                </div>
                                
                                <!-- Cantidad -->
                                <div class="flex items-center">
                                    <div class="flex items-center border border-gray-200 rounded">
                                        <button onclick="decreaseQuantity({{ $item->id }})" 
                                                class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <span id="quantity-{{ $item->id }}" class="px-4 py-2 text-sm font-medium text-gray-700 min-w-[3rem] text-center">{{ $item->quantity }}</span>
                                        <button onclick="increaseQuantity({{ $item->id }})" class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Producto -->
                                <div>
                                    <h3 class="text-base font-semibold text-gray-900">{{ $item->plan->name }} - {{ $item->billing_period }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->plan->description }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Precio unitario: ${{ number_format($item->unit_price) }}</p>
                                </div>
                                
                                <!-- Total -->
                                <div class="text-center">
                                    <p id="total-{{ $item->id }}" class="text-lg font-bold text-gray-900">${{ number_format($item->total_price) }}</p>
                                    <p class="text-xs text-gray-500">COP</p>
                                </div>
                                
                                <!-- Acciones -->
                                <div class="text-center">
                                    <button onclick="removeFromCart({{ $item->id }})" class="inline-flex items-center justify-center w-10 h-10 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tu carrito está vacío</h3>
                            <p class="text-gray-600 mb-6">Agrega algunos productos para comenzar</p>
                            <a href="{{ route('plans') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                                Ver Planes
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        @endforelse
            </div>
        </div>

        <!-- Actions -->
        @if($cartItems->count() > 0)
        <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-between items-center">
            <a href="{{ route('plans') }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Seguir Comprando
            </a>
            
            <div class="flex gap-3">
                <button onclick="clearCart()" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors">
                    Vaciar Carrito
                </button>
                <button onclick="window.location.href='{{ route('checkout') }}'" class="px-8 py-3 bg-[#2268bd] hover:bg-[#1a4c8c] text-white font-semibold rounded-lg transition-colors">
                    Proceder al Pago
                </button>
            </div>
        </div>
        @endif
    </div>
</div>


<!-- Modal Vaciar Carrito -->
<div id="clearCartModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black bg-opacity-50" role="dialog" aria-modal="true">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-auto transform transition-all">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.98-.833-2.75 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Vaciar Carrito</h3>
            </div>
            <button onclick="hideClearCartModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Content -->
        <div class="p-6">
            <p class="text-gray-600 mb-6">
                ¿Estás seguro de que quieres vaciar todo el carrito? Se eliminarán todos los productos y esta acción no se puede deshacer.
            </p>
            
            <!-- Warning -->
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-6">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-orange-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.98-.833-2.75 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-orange-800">¡Atención!</p>
                        <p class="text-sm text-orange-700">Se perderán todos los productos del carrito</p>
                    </div>
                </div>
            </div>
            
            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <button onclick="hideClearCartModal()" 
                        class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
                <button onclick="confirmClearCart()" 
                        class="flex-1 px-4 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500">
                    Vaciar Carrito
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// CSRF Token para las peticiones AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Funciones para actualizar cantidad
function increaseQuantity(itemId) {
    const quantityElement = document.getElementById(`quantity-${itemId}`);
    let quantity = parseInt(quantityElement.textContent) + 1;
    
    updateCartQuantity(itemId, quantity);
}

function decreaseQuantity(itemId) {
    const quantityElement = document.getElementById(`quantity-${itemId}`);
    let quantity = parseInt(quantityElement.textContent);
    
    if (quantity > 1) {
        quantity -= 1;
        updateCartQuantity(itemId, quantity);
    }
}

function updateCartQuantity(itemId, quantity) {
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
            // Actualizar cantidad en la vista
            document.getElementById(`quantity-${itemId}`).textContent = quantity;
            // Actualizar total del producto
            document.getElementById(`total-${itemId}`).textContent = `$${data.new_total.toLocaleString()}`;
            // Actualizar total general en el header
            document.getElementById('cart-grand-total').textContent = `$${data.grand_total.toLocaleString()}`;
            
            // Manejar el botón de disminuir
            const decreaseBtn = document.querySelector(`[onclick="decreaseQuantity(${itemId})"]`);
            if (quantity <= 1) {
                decreaseBtn.classList.add('opacity-50', 'cursor-not-allowed');
                decreaseBtn.disabled = true;
            } else {
                decreaseBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                decreaseBtn.disabled = false;
            }
            
            // Actualizar badge del carrito en navbar si existe
            if (typeof updateCartBadge === 'function') {
                // Calcular nueva cantidad total
                const allQuantities = document.querySelectorAll('[id^="quantity-"]');
                let totalItems = 0;
                allQuantities.forEach(el => {
                    totalItems += parseInt(el.textContent);
                });
                updateCartBadge(totalItems);
            }
        } else {
            showAlert('Error al actualizar la cantidad', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error al actualizar la cantidad', 'error');
    });
}

function removeFromCart(productId) {
    fetch(`/cart/remove/${productId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const itemElement = document.getElementById(`cart-item-${productId}`);
            itemElement.style.transition = 'opacity 0.3s ease';
            itemElement.style.opacity = '0';
            setTimeout(() => window.location.reload(), 300);
        } else {
            showAlert('Error al eliminar el producto', 'error');
        }
    })
    .catch(error => showAlert('Error al eliminar el producto', 'error'));
}

function clearCart() {
    // Mostrar modal personalizado para vaciar carrito
    showClearCartModal();
}

function showEmptyCart() {
    // Aquí podrías mostrar un mensaje de carrito vacío
    const cartContainer = document.querySelector('.divide-y');
    cartContainer.innerHTML = `
        <div class="p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tu carrito está vacío</h3>
            <p class="text-gray-600 mb-6">Agrega algunos productos para comenzar</p>
            <a href="{{ route('plans') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Ver Planes
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    `;
}

// Funciones para modales personalizados

function showClearCartModal() {
    document.getElementById('clearCartModal').classList.remove('hidden');
    document.getElementById('clearCartModal').classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function hideClearCartModal() {
    document.getElementById('clearCartModal').classList.add('hidden');
    document.getElementById('clearCartModal').classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}

function confirmClearCart() {
    fetch('/cart/clear', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Recargar la página para mostrar el carrito vacío
            window.location.reload();
        } else {
            showAlert('Error al vaciar el carrito', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('Error al vaciar el carrito', 'error');
    });
    
    hideClearCartModal();
}
</script>
@endsection