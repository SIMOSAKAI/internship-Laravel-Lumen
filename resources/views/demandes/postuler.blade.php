@extends('layout.base')
@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('demande.sauvegarder')}}" method="post" enctype="multipart/form-data">
            <h2 class="text-2xl font-bold mb-6">Détails Personnels</h2>

            <!-- CIN -->
            <div class="mb-4">
                <label for="cin" class="block text-sm font-medium text-gray-700">CIN</label>
                <input type="text" id="cin" name="cin" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['cin']))
                <p class="mt-2 text-sm text-red-600">
                {{  $errors['cin'][0] }}
                </p>
                @endif
            </div>

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="nom" name="nom" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['nom']))
                <p class="mt-2 text-sm text-red-600">
                {{  $errors['nom'][0] }}
                </p>
                @endif
            </div>

            <!-- Prenom -->
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['prenom']))
                <p class="mt-2 text-sm text-red-600">
                {{  $errors['prenom'][0] }}
                </p>
                @endif
            </div>

            <!--  -->
            <div class="mb-4">
                <label for="idniveau" class="block text-sm font-medium text-gray-700">Niveau</label>
                <select id="idniveau" name="idniveau" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                    @foreach ($niveaux as $niveau)
                        <option value="{{ $niveau->id }}">
                            {{ $niveau->niveau }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sexe -->
            <div class="mb-4">
                <label for="sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                <select id="sexe" name="sexe" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                    <option value="Male">Masculin</option>
                    <option value="Female">Féminin</option>
                </select>
            </div>

            <!-- Etablissement -->
            <div class="mb-4">
                <label for="etablissement" class="block text-sm font-medium text-gray-700">Etablissement</label>
                <input type="text" id="etablissement" name="etablissement" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['etablissement']))
                <p class="mt-2 text-sm text-red-600">
                {{  $errors['etablissement'][0] }}
                </p>
                @endif
            </div>
            <!-- Télécharger un CV -->
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="cv_input">Télécharger un CV</label>
                <input 
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                    id="cv_input" 
                    type="file" 
                    name="cv_input"
                    >
                    @if(isset($errors['cv_input']))
                    <p class="mt-2 text-sm text-red-600">
                    {{  $errors['cv_input'][0] }}
                    </p>
                    @endif
            </div>

            <h2 class="text-2xl font-bold mb-6 mt-8">Détails du Stage</h2>
            <!-- Date Debut -->
            <div class="mb-4">
                <label for="dateDebut" class="block text-sm font-medium text-gray-700">Date Début</label>
                <input type="date" id="dateDebut" name="dateDebut" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['dateDebut']))
                    <p class="mt-2 text-sm text-red-600">
                    {{  $errors['dateDebut'][0] }}
                    </p>
                @endif
            </div>

            <!-- Date Fin -->
            <div class="mb-4">
                <label for="dateFin" class="block text-sm font-medium text-gray-700">Date Fin</label>
                <input type="date" id="dateFin" name="dateFin" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['dateFin']))
                    <p class="mt-2 text-sm text-red-600">
                    {{  $errors['dateFin'][0] }}
                    </p>
                @endif
            </div>
            <!-- Objet -->
            <div class="mb-4">
                <label for="objet" class="block text-sm font-medium text-gray-700">Objet</label>
                <input type="text" id="objet" name="objet" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                @if(isset($errors['objet']))
                    <p class="mt-2 text-sm text-red-600">
                    {{  $errors['objet'][0] }}
                    </p>
                @endif
            </div>

            <!-- Detail -->
            <div class="mb-4">
                <label for="detail" class="block text-sm font-medium text-gray-700">Détail</label>
                <textarea id="detail" name="detail" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"></textarea>
                @if(isset($errors['detail']))
                    <p class="mt-2 text-sm text-red-600">
                    {{  $errors['detail'][0] }}
                    </p>
                @endif
            </div>

            <!-- Entite -->
            <div class="mb-4">
                <label for="idEntite" class="block text-sm font-medium text-gray-700">Entité</label>
                <select id="idEntite" name="idEntite" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md">
                    
                    @foreach ($entites as $entite)
                        <option value="{{ $entite->id }}">
                            {{ $entite->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Confirmer</button>
        </form>
    </div>
</div>
@endsection