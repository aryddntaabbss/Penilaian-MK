<div class="text-sm text-gray-600 mb-4">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li>
                <a href="/dashboard" class="text-gray-500 hover:text-teal-600">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            @foreach ($items as $item)
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L11.586 9 7.293 4.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    @if ($loop->last)
                    <span class="text-teal-600 font-semibold">{{ $item['title'] }}</span>
                    @else
                    <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-teal-600">{{ $item['title'] }}</a>
                    @endif
                </div>
            </li>
            @endforeach
        </ol>
    </nav>
</div>