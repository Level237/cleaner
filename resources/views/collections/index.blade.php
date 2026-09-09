@extends('layouts.store')

@section('content')
<!-- Hero Section Collections -->
<div class="relative w-full bg-[#1a2217] pt-32 sm:pt-40 pb-20 sm:pb-24 flex items-center justify-center overflow-hidden">
    <div class="relative z-20 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <span class="inline-block text-[#d4f977] font-medium text-xs sm:text-sm uppercase tracking-[0.2em] mb-3">
            Gamme Exclusives
        </span>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-medium text-white mb-4 sm:mb-6 leading-tight">Nos Collections</h1>
        <div class="w-16 h-1 bg-[#d4f977] mx-auto rounded-full"></div>
    </div>
</div>

<div class="bg-[#F8F9F5] py-12 sm:py-20 lg:py-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($collections as $collection)
                <a href="{{ route('collections.show', $collection->slug) }}" class="block bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-300">
                    <div class="aspect-[16/10] bg-gray-100 relative overflow-hidden">
                        @if($collection->mainImage->first())
                            <img src="{{ asset('storage/' . $collection->mainImage->first()->path) }}" alt="{{ $collection->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#e4f5e7] text-[#3ab54a]">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 sm:p-6">
                        <h2 class="text-lg sm:text-xl font-serif font-semibold text-[#1a2217] mb-2">{{ $collection->name }}</h2>
                        <p class="text-gray-500 text-xs sm:text-sm font-normal line-clamp-3 leading-relaxed">{{ $collection->description }}</p>
                        <div class="mt-4 flex items-center text-[#3ab54a] font-medium text-xs sm:text-sm group-hover:text-[#283324] transition-colors">
                            Explorer la collection
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-base sm:text-lg">Aucune collection disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
