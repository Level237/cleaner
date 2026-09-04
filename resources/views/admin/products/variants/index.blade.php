@extends('layouts.admin')

@section('title', 'Variantes : ' . $product->name)

@section('header')
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">&larr; Retour au produit</a>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Variantes : {{ $product->name }}</h2>
            <p class="text-sm text-gray-500 mt-1">Gérez les différentes options d'achat (poids, emballage) pour ce produit.</p>
        </div>
        <a href="{{ route('admin.products.variants.create', $product) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
            Ajouter une variante
        </a>
    </div>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom & SKU</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poids (g)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Par défaut</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($variants as $variant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $variant->name }}</div>
                                <div class="text-xs text-gray-500">SKU: {{ $variant->sku ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                {{ number_format($variant->price, 2) }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($variant->stock_status === 'in_stock')
                                    <span class="text-sm text-green-600 font-medium">En stock ({{ $variant->stock_quantity ?? 0 }})</span>
                                @elseif($variant->stock_status === 'out_of_stock')
                                    <span class="text-sm text-red-600 font-medium">Rupture</span>
                                @else
                                    <span class="text-sm text-yellow-600 font-medium">Précommande</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $variant->weight_grams ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($variant->is_default)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Oui</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.variants.edit', [$product, $variant]) }}" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                                <form action="{{ route('admin.products.variants.destroy', [$product, $variant]) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette variante ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                Aucune variante trouvée pour ce produit.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
