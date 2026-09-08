@extends('layouts.store')

@section('content')
<div class="bg-[#F8F9F5] min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-serif font-extrabold text-[#1a2217] mb-12 text-center">Nos Collections</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($collections as $collection)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-shadow">
                    <div class="aspect-w-16 aspect-h-10 bg-gray-100 relative overflow-hidden">
                        @if($collection->mainImage->first())
                            <img src="{{ asset('storage/' . $collection->mainImage->first()->path) }}" alt="{{ $collection->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#e4f5e7] text-[#3ab54a]">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-[#1a2217] mb-2">{{ $collection->name }}</h2>
                        <p class="text-gray-500 text-sm line-clamp-3">{{ $collection->description }}</p>
                        <div class="mt-4 flex items-center text-[#3ab54a] font-medium text-sm group-hover:text-[#283324] transition-colors">
                            Explorer la collection
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucune collection disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
