@if ($paginator->hasPages())
    <nav class="flex justify-between items-center mb-4">
        {{-- Previous Page Link --}}
        <div>
            @if ($paginator->onFirstPage())
                <span class="bg-gray-200 text-gray-500 py-2 px-4 rounded-md">Précédent</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Précédent</a>
            @endif
        </div>

        {{-- Page Number Links --}}
        <div class="flex space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="text-gray-700 py-2 px-4">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="bg-blue-500 text-white py-2 px-4 rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        <div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Suivant</a>
            @else
                <span class="bg-gray-200 text-gray-500 py-2 px-4 rounded-md">Suivant</span>
            @endif
        </div>
    </nav>
@endif
