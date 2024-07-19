@extends('layout.base')

@section('content')
<nav class="bg-white border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap">
                CHAMBRE DES REPRÉSENTANTS</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="{{ route('stagiaires.refuses') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Stagiaires refusés</a>
                </li>
                <li>
                    <a href="{{ route('stagiaires.acceptees') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Mes stagiaires</a>
                </li>
                <li>
                    <a href="{{ route('stagiaires.deconnecter') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mx-auto max-w-screen-lg py-10">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">CIN</th>
                    <th scope="col" class="px-6 py-3">Nom</th>
                    <th scope="col" class="px-6 py-3">Prénom</th>
                    <th scope="col" class="px-6 py-3">Niveau</th>
                    <th scope="col" class="px-6 py-3">Sexe</th>
                    <th scope="col" class="px-6 py-3">Etablissement</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stagiaires as $stagiaire)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $stagiaire->cin }}</td>
                        <td class="px-6 py-4">{{ $stagiaire->nom }}</td>
                        <td class="px-6 py-4">{{ $stagiaire->prenom }}</td>
                        <td>{{ $stagiaire->niveau }}</td>
                        <td class="px-6 py-4">{{ $stagiaire->sexe }}</td>
                        <td class="px-6 py-4">{{ $stagiaire->etablissement }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <!-- Boutons d'action -->
                            <div class="flex space-x-4">
                                <form action="{{ route('demande.accepter') }}" method="POST">
                                    
                                    <input type="hidden" name="demande_id" value="{{ $stagiaire->id }}">
                                    <button type="submit" class="p-2 bg-green-500 text-white rounded-md flex items-center space-x-2 hover:bg-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                                
                            
                                <!-- Bouton Refuser -->
                                <form action="{{ route('demande.refuser') }}" method="POST" class="inline">
                                    <input type="hidden" name="demande_id" value="{{ $stagiaire->id }}">
                                    <button type="submit" class="p-2 bg-red-500 text-white rounded-md flex items-center space-x-2 hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                            <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                                        </svg>
                                    </button>
                                </form>
                            
                                

                                <a href={{ route('stagiaire.show', ['stagiaireId' => $stagiaire->id]) }} class="p-2 bg-blue-500 text-white rounded-md flex items-center space-x-2 hover:bg-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                            <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                                        </svg>
                                </a>
                            </div>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
