@php
    $image = $product->media->where('is_primary', true)->first();
@endphp

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => $product->short_description ?: $product->description,
    'image' => $image ? asset('storage/' . $image->path) : null,
    'sku' => $product->sku,
    'brand' => ['@type' => 'Brand', 'name' => config('app.name')],
    'offers' => [
        '@type' => 'Offer',
        'url' => url('/produits/' . $product->slug),
        'priceCurrency' => $product->currency ?: session('currency', 'XAF'),
        'price' => number_format((float) $product->price, 2, '.', ''),
        'availability' => $product->stock_status === 'in_stock'
            ? 'https://schema.org/InStock'
            : 'https://schema.org/OutOfStock',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
