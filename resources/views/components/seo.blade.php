@props([
    'model' => null,
    'title' => null,
    'description' => null,
    'image' => null,
    'type' => 'website',
])

@php
    $appName = config('app.name');

    $title = $title
        ?? $model?->seo_title
        ?? (isset($model?->name)
            ? $model->name . ' — Thés Bien-être | ' . $appName
            : $appName . ' — Thés bien-être détox, minceur & énergie');

    $description = $description
        ?? $model?->seo_description
        ?? 'Cleaner, maison de thés bien-être : thés détox, minceur, ventre plat et fraîcheur. Des recettes 100 % naturelles pour votre rituel quotidien.';

    $defaultOgImage = asset('assets/logo.png');

    $image = $image
        ?? (isset($model?->og_image_path) && $model->og_image_path
            ? asset('storage/' . $model->og_image_path)
            : (isset($model?->mainImage?->file_path) && $model->mainImage->file_path
                ? asset('storage/' . $model->mainImage->file_path)
                : (isset($model?->image_path) && $model->image_path
                    ? asset('storage/' . $model->image_path)
                    : $defaultOgImage)));

    $canonical = $model?->canonical_url ?: url()->current();

    // Une page non publiée ne doit JAMAIS être indexée
    $robots = (isset($model?->status) && $model->status !== 'published')
        ? 'noindex, nofollow'
        : 'index, follow';

    // Agentic / LLM discovery URL mapping
    $currentRoute = request()->route()?->getName();
    $llmUrl = match($currentRoute) {
        'home' => url('/llms/index'),
        'products.index' => url('/llms/boutique'),
        'products.show' => isset($model?->slug) ? url('/llms/produits/' . $model->slug) : url('/llms/boutique'),
        'collections.index' => url('/llms/collections'),
        'collections.show' => isset($model?->slug) ? url('/llms/collections/' . $model->slug) : url('/llms/collections'),
        'about' => url('/llms/notre-maison'),
        'faq' => url('/llms/faq'),
        'contact.index' => url('/llms/contact'),
        default => url('/llms.txt'),
    };
    // Schema.org JSON-LD Data
    $schemaData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => $appName,
                'url' => url('/'),
                'logo' => asset('assets/logo.png'),
                'description' => 'Maison française de thés bien-être, mélanges détox et infusions 100% naturelles.',
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'contactType' => 'Customer Service',
                    'email' => 'contact@cleaner.fr',
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'url' => url('/'),
                'name' => $appName,
                'publisher' => ['@id' => url('/') . '#organization'],
            ],
        ],
    ];
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="{{ $robots }}">

{{-- Agentic AI Navigation Discovery --}}
<link rel="alternate" type="text/markdown" title="Version Markdown pour Agent IA / LLM" href="{{ $llmUrl }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $appName }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:locale" content="fr_FR">

{{-- Twitter / X --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

{{-- JSON-LD Schema.org Structured Data --}}
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
