@extends('layouts.store')

@section('content')
    <!-- Hero Section -->
    <x-hero />
    <x-trust-section />
    <x-categories-section :categories="$featuredCategories" />
    <x-best-sellers-section :products="$bestSellers" />
@endsection
