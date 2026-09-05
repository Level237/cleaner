@extends('layouts.admin')

@section('title', 'Mon Profil')

@section('header')
    <div class="flex justify-between items-center w-full">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Mon Profil</h2>
    </div>
@endsection

@section('content')
<div class="w-full max-w-7xl mx-auto space-y-6">

    <!-- Informations du profil -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-1">Informations personnelles</h3>
        <p class="text-sm text-gray-500 mb-6">Mettez à jour les informations de votre compte et votre adresse email.</p>
        
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 gap-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-start">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

    <!-- Sécurité (Mot de passe) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-1">Sécurité</h3>
        <p class="text-sm text-gray-500 mb-6">Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.</p>
        
        <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Ancien mot de passe -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Nouveau mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" autocomplete="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-start">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-gray-900 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                    Mettre à jour le mot de passe
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
