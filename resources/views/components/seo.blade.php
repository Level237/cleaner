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
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="{{ $robots }}">

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
