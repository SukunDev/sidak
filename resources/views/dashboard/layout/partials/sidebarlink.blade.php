<a class="flex items-center px-4 py-2 gap-4  {{ Request::is('dashboard') ? 'bg-black/[.10] text-white' : 'hover:bg-black/[.05] hover:text-white' }} transition duration-300"
    href="{{ $slug }}">
    {{ $slot }}
    <span class="sidebar-item capitalize">
        {{ $title }}
    </span>
</a>
