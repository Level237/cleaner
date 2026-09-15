@extends('layouts.store')

@section('content')
    <!-- Hero Section -->
    <x-hero />
    <x-trust-section />
    
    <x-categories-section :categories="$featuredCategories" />
    <x-why-cleaner-section />
    <x-best-sellers-section :products="$bestSellers" />
    <x-benefits-section />
    <x-video-section />
@endsection
