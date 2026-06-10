<div class="space-y-4">
    @php
        $data = $data ?? ['hasMissingData' => false, 'missingData' => []];
    @endphp
    @if($data['hasMissingData'])
        <div class="rounded-xl bg-yellow-50 p-6 border border-yellow-200">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-yellow-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-yellow-900">Completa tu perfil</h3>
                    <p class="text-sm text-yellow-800 mt-1">Para mejorar tu experiencia, completa la siguiente información:</p>
                    <ul class="mt-2 space-y-1">
                        @foreach($data['missingData'] as $field)
                            <li class="text-sm text-yellow-800">• {{ $field }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
