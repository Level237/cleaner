@props([
    'title',
    'value',
    'subtitle' => null,
    'badge' => null,
    'badgeType' => 'success', // success, danger, warning, neutral
    'icon' => null
])

@php
    $badgeClasses = [
        'success' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
        'danger' => 'bg-rose-50 text-rose-600 border border-rose-100',
        'warning' => 'bg-amber-50 text-amber-600 border border-amber-100',
        'neutral' => 'bg-gray-100 text-gray-600 border border-gray-200',
    ][$badgeType] ?? 'bg-emerald-50 text-emerald-600';
@endphp

<div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-200">
    <div class="flex items-center justify-between mb-3">
        <span class="text-sm font-semibold text-gray-700">{{ $title }}</span>
        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
            @if($icon)
                {!! $icon !!}
            @else
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            @endif
        </div>
    </div>
    
    <div class="flex items-baseline space-x-2">
        <span class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $value }}</span>
        @if($badge)
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $badgeClasses }}">
                {{ $badge }}
            </span>
        @endif
    </div>

    @if($subtitle)
        <p class="text-xs text-gray-400 mt-2 font-normal">{{ $subtitle }}</p>
    @endif
</div>
