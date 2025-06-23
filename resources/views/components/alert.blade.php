@props(['type' => 'info', 'message'])

@php
    $bgColors = [
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'error' => 'bg-red-100 border-red-500 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
        'info' => 'bg-blue-100 border-blue-500 text-blue-700',
    ];
    
    $iconClasses = [
        'success' => 'fas fa-check-circle text-green-500',
        'error' => 'fas fa-exclamation-circle text-red-500',
        'warning' => 'fas fa-exclamation-triangle text-yellow-500',
        'info' => 'fas fa-info-circle text-blue-500',
    ];
    
    $bgClass = $bgColors[$type] ?? $bgColors['info'];
    $iconClass = $iconClasses[$type] ?? $iconClasses['info'];
@endphp

<div class="border-l-4 p-4 {{ $bgClass }} rounded shadow-sm my-3" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="{{ $iconClass }} text-xl"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm">{{ $message }}</p>
        </div>
    </div>
</div>