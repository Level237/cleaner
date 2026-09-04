@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('header')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-4 pb-2">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard</h2>
            <p class="text-sm text-gray-500 mt-1">Aperçu analytique et santé de votre catalogue</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-white px-4 py-2.5 rounded-xl border border-gray-200 shadow-sm flex items-center text-sm font-medium text-gray-600">
                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ now()->translatedFormat('d M Y') }}</span>
            </div>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-sm flex items-center transition">
                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nouveau produit
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="w-full space-y-8">
    
    {{-- SECTION 1 : KPIs GLOBAUX (Modern cards inspired by reference screenshot) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <x-stat-card 
            title="Produits Publiés" 
            :value="$stats['published_products']" 
            subtitle="sur {{ $stats['total_products'] }} au total" 
            badge="Actifs" 
            badgeType="success"
            :icon="'<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M15 12a3 3 0 11-6 0 3 3 0 016 0z\'/><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\'/></svg>'"
        />

        <x-stat-card 
            title="En Brouillon" 
            :value="$stats['draft_products']" 
            subtitle="À finaliser" 
            badge="Attente" 
            badgeType="warning"
            :icon="'<svg class=\'w-4 h-4 text-amber-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\'/></svg>'"
        />

        <x-stat-card 
            title="Catégories" 
            :value="$stats['total_categories']" 
            subtitle="Familles organisées" 
            badge="Catalog" 
            badgeType="neutral"
            :icon="'<svg class=\'w-4 h-4 text-blue-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z\'/></svg>'"
        />

        <x-stat-card 
            title="Collections" 
            :value="$stats['total_collections']" 
            subtitle="Sélections marketing" 
            badge="Market" 
            badgeType="neutral"
            :icon="'<svg class=\'w-4 h-4 text-indigo-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10\'/></svg>'"
        />
    </div>

    {{-- SECTION 2 : RADAR SEO & QUALITÉ DU CATALOGUE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900">Radar SEO & Qualité Catalogue</h3>
                    <p class="text-xs text-gray-400">Détection automatique des anomalies impactant le référencement et les ventes</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-5">
            <x-alert-card 
                title="Sans Image Principale" 
                :count="$alerts['missing_main_image']" 
                route="{{ route('admin.products.index', ['filter' => 'no_image']) }}" 
            />
            <x-alert-card 
                title="Sans Meta Description" 
                :count="$alerts['missing_seo_description']" 
                route="{{ route('admin.products.index', ['filter' => 'no_seo']) }}" 
            />
            <x-alert-card 
                title="Sans Description Courte" 
                :count="$alerts['missing_short_description']" 
                route="{{ route('admin.products.index', ['filter' => 'no_short_desc']) }}" 
            />
            <x-alert-card 
                title="Rupture de Stock" 
                :count="$alerts['out_of_stock']" 
                route="{{ route('admin.products.index', ['filter' => 'out_of_stock']) }}" 
                danger="true"
            />
        </div>
    </div>

    {{-- SECTION 3 & 4 : ACTIONS RAPIDES + ACTIVITÉ RÉCENTE --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Actions Rapides -->
        <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-900 mb-1">Actions Rapides</h3>
                <p class="text-xs text-gray-400 mb-5">Raccourcis de création de contenu</p>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-blue-50/60 rounded-xl border border-gray-100 hover:border-blue-100 transition group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition-colors">Créer un Produit</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="{{ route('admin.categories.create') }}" class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-emerald-50/60 rounded-xl border border-gray-100 hover:border-emerald-100 transition group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-emerald-600 transition-colors">Créer une Catégorie</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <a href="{{ route('admin.collections.create') }}" class="flex items-center justify-between p-3.5 bg-gray-50 hover:bg-purple-50/60 rounded-xl border border-gray-100 hover:border-purple-100 transition group">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-purple-600 transition-colors">Créer une Collection</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-600 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Activité Récente -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Derniers produits modifiés</h3>
                    <p class="text-xs text-gray-400">Activités récentes sur le catalogue</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800">Voir tout →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <th class="pb-3 pl-1">Produit</th>
                            <th class="pb-3">Statut</th>
                            <th class="pb-3">Catégorie</th>
                            <th class="pb-3 text-right pr-1">Modifié le</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($recentProducts as $product)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-3 pl-1 font-medium text-gray-900">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="hover:text-blue-600 transition-colors">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td class="py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $product->status === 'published' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                        {{ $product->status === 'published' ? 'Publié' : 'Brouillon' }}
                                    </span>
                                </td>
                                <td class="py-3 text-gray-500 text-xs font-medium">
                                    {{ $product->primaryCategory->name ?? '-' }}
                                </td>
                                <td class="py-3 text-right pr-1 text-xs text-gray-400">
                                    {{ $product->updated_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-xs text-gray-400">
                                    Aucun produit enregistré pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
