@props(['title', 'count', 'route', 'danger' => false])

<a href="{{ $route }}" class="group block p-4 rounded-2xl border transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md
    {{ $danger ? 'border-red-100 bg-red-50/60 hover:bg-red-50 hover:border-red-200' : 'border-amber-100 bg-amber-50/60 hover:bg-amber-50 hover:border-amber-200' }}">
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm font-semibold {{ $danger ? 'text-red-900' : 'text-amber-900' }}">{{ $title }}</span>
        <span class="px-2.5 py-1 rounded-full text-xs font-bold shadow-sm
            {{ $danger ? 'bg-red-500 text-white' : 'bg-amber-500 text-white' }}">
            {{ $count }}
        </span>
    </div>
    <div class="flex items-center text-xs font-medium {{ $danger ? 'text-red-600 group-hover:text-red-700' : 'text-amber-600 group-hover:text-amber-700' }}">
        <span>Cliquer pour corriger</span>
        <svg class="w-3.5 h-3.5 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
        </svg>
    </div>
</a>
