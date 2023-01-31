<button
    class="btn-dropdown flex w-full items-center justify-between px-4 py-2 {{ Request::is($slug . '*') ? 'bg-black/[.10] text-white' : 'hover:bg-black/[.05] hover:text-white' }} transition duration-300">
    <div class="flex items-center gap-4">
        {{ $slot }}
        <span class="capitalize sidebar-item">{{ $title }}</span>
    </div>
    <svg id="arrow-dropdown"
        class="sidebar-item w-7 fill-current transition duration-300 {{ Request::is($slug . '*') ? 'flip' : '' }}"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M24 24H0V0h24v24z" fill="none" opacity=".87" />
        <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z" />
    </svg>
</button>
<ul class="item-dropdown {{ Request::is($slug . '*') ? '' : 'hidden' }}">
    @foreach ($dropdowns as $item)
        <li>
            <a class="flex items-center pl-14 pr-4 py-2 gap-4 {{ Request::is($item['slug']) ? 'bg-black/[.10] text-white' : 'hover:bg-black/[.05] hover:text-white' }} transition duration-300 capitalize"
                href="/{{ $item['slug'] }}">
                {{ $item['title'] }}
            </a>
        </li>
    @endforeach
</ul>
