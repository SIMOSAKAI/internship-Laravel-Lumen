@extends('layout.base')

@section('content')
    <nav class="bg-white border-gray-200">
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

    <div class="container mx-auto max-w-screen-lg py-10">
      <form method="GET" action="{{ route('stagiaires.acceptees') }}" class="flex justify-start max-w-xl mb-6 w-full">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" name="query" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher un stagiaire" required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rechercher</button>
        </div>
    </form>
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
                                <div class="flex space-x-4">
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
        <!-- Pagination Links -->
    <div class="mt-4">
        {{ $stagiaires->links('stagiaires.simple') }}
    </div>
    </div>
@endsection
