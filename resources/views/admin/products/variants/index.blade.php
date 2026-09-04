@extends('layouts.admin')

@section('title', 'Variantes : ' . $product->name)

@section('header')
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">Produits</a>
        <span class="text-gray-400">/</span>
        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800">{{ Str::limit($product->name, 30) }}</a>
        <span class="text-gray-400">/</span>
        <span class="text-gray-800">Variantes</span>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 sm:mb-0">Variantes du produit</h3>
        <a href="{{ route('admin.products.variants.create', $product) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Ajouter une variante
        </a>
    </div>

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
