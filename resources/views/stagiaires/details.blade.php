@extends('layout.base')

@section('content')
    
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">
                    CHAMBRE DES REPRÉSENTANTS</span>
            </a>
            
            <button onclick="history.back()" class="p-2 bg-transparent text-gray-500 rounded-md flex items-center space-x-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="text-sm">Retourner</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </nav>

    
    <div class="container mx-auto p-4">
        <!-- Stagiaire Card -->
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 ml-2">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h2>
            <div class="flex flex-wrap -mx-2">
                <div class="w-full lg:w-1/2 px-2 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">CIN</p>
                        <p class="text-gray-900">{{ $stagiaire->cin }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-2 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Sexe</p>
                        <p class="text-gray-900">{{ $stagiaire->sexe }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-2 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Etablissement</p>
                        <p class="text-gray-900">{{ $stagiaire->etablissement }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-2 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Niveau</p>
                        <p class="text-gray-900">{{ $stagiaire->niveau }}</p>
                    </div>
                </div>
                <div class="w-full px-2 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Entité</p>
                        <p class="text-gray-900">{{ $stagiaire->entiteName }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Internship Details -->
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md mt-4">
            <h2 class="text-2xl font-semibold mb-4">Détails du Stage</h2>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/2 px-4 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Date de Demande</p>
                        <p class="text-gray-900">{{ $stagiaire->dateDemande }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-4 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Date de Début</p>
                        <p class="text-gray-900">{{ $stagiaire->dateDebut }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-4 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Date de Fin</p>
                        <p class="text-gray-900">{{ $stagiaire->dateFin }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-4 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Objet</p>
                        <p class="text-gray-900">{{ $stagiaire->objet }}</p>
                    </div>
                </div>
                <div class="w-full px-4 mb-4">
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-gray-700 text-sm font-semibold">Détail</p>
                        <p class="text-gray-900">{{ $stagiaire->detail }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
