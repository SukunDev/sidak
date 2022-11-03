@if ($paginator->lastPage() > 1)
    @php
        if ($paginator->currentPage() - 3 < 1) {
            $startCount = 1;
            if ($paginator->lastPage() <= 7) {
                $endCount = $paginator->lastPage();
            } else {
                $endCount = 7;
            }
        } else {
            $startCount = $paginator->currentPage() - 3;
            $endCount = $paginator->currentPage() + 3;
            if ($endCount > $paginator->lastPage()) {
                $endCount = $paginator->lastPage();
                $startCount = $paginator->lastPage() - 6;
                if ($startCount < 1) {
                    $startCount = 1;
                }
            }
    } @endphp <div class="flex items-center space-x-1 justify-center">
        @if ($paginator->currentPage() > 1)
            <a href="{{ $paginator->url($paginator->currentPage() - 1) }}"
                class="px-1.5 md:px-2 py-2 font-bold fill-gray-600 bg-gray-50 rounded-md hover:bg-slate-700 border border-slate-700 hover:fill-white">
                <svg class="w-auto h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z" />
                </svg>
            </a>
        @endif
        @for ($i = $startCount; $i <= $endCount; $i++)
            <a href="{{ $paginator->url($i) }}"
                class="px-3 md:px-4 py-2 font-bold rounded-md text-xs md:text-base border border-slate-700 {{ $paginator->currentPage() == $i ? 'pointer-events-none cursor-default bg-slate-700 text-white' : 'text-gray-600 bg-gray-50 hover:bg-slate-700 hover:text-white' }}">
                {{ $i }}
            </a>
        @endfor
        @if ($paginator->currentPage() < $paginator->lastPage())
            <a href="{{ $paginator->url($paginator->currentPage() + 1) }}"
                class="px-1.5 md:px-2 py-2 font-bold fill-gray-600 bg-gray-50 rounded-md hover:bg-slate-700 border border-slate-700 hover:fill-white">
                <svg class="w-auto h-4 md:h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z" />
                </svg>
            </a>
        @endif
    </div>
@endif
