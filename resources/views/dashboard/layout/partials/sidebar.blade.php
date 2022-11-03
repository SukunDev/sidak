<div id="blackopa" class="fixed z-[99] inset-0 bg-black opacity-70" style="display: none">
</div>
<div id="sidebar" class="fixed inset-y-0 left-0 z-[100] bg-slate-700 active-sidebar -translate-x-64 md:translate-x-0">
    <div id="sidebar-content" class="flex flex-col text-white font-Poppins" style="width: 16rem;">
        <div class="hidden md:flex items-center justify-between px-4 py-4 bg-black/[.15]">
            <div class="flex items-center gap-4">
                <svg class="w-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z" />
                </svg>
                <p class="sidebar-item text-lg">Sidak</p>
            </div>
            <button class="sidebar-item-button">
                <svg class="w-7 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6-6-6z" />
                </svg>
            </button>
        </div>
        <ul class="text-gray-300">
            <li>
                @component('dashboard.layout.partials.sidebarlink')
                    @slot('title')
                        dashboard
                    @endslot
                    @slot('slug')
                        /dashboard
                    @endslot
                    <svg class="w-7 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z" />
                    </svg>
                @endcomponent
            </li>
            <li>
                @component('dashboard.layout.partials.sidebardropdownlink',
                    [
                        'title' => 'alat',
                        'slug' => 'dashboard/alat',
                        'dropdowns' => [
                            ['title' => 'semua', 'slug' => 'dashboard/alat'],
                            ['title' => 'tambah alat', 'slug' => 'dashboard/alat/tambah'],
                        ],
                    ])
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g>
                            <rect fill="none" height="24" width="24" />
                        </g>
                        <g>
                            <path
                                d="M19.93,8.35l-3.6,1.68L14,7.7V6.3l2.33-2.33l3.6,1.68c0.38,0.18,0.82,0.01,1-0.36c0.18-0.38,0.01-0.82-0.36-1l-3.92-1.83 c-0.38-0.18-0.83-0.1-1.13,0.2L13.78,4.4C13.6,4.16,13.32,4,13,4c-0.55,0-1,0.45-1,1v1H8.82C8.4,4.84,7.3,4,6,4C4.34,4,3,5.34,3,7 c0,1.1,0.6,2.05,1.48,2.58L7.08,18H6c-1.1,0-2,0.9-2,2v1h13v-1c0-1.1-0.9-2-2-2h-1.62L8.41,8.77C8.58,8.53,8.72,8.28,8.82,8H12v1 c0,0.55,0.45,1,1,1c0.32,0,0.6-0.16,0.78-0.4l1.74,1.74c0.3,0.3,0.75,0.38,1.13,0.2l3.92-1.83c0.38-0.18,0.54-0.62,0.36-1 C20.75,8.34,20.31,8.17,19.93,8.35z M6,8C5.45,8,5,7.55,5,7c0-0.55,0.45-1,1-1s1,0.45,1,1C7,7.55,6.55,8,6,8z M11.11,18H9.17 l-2.46-8h0.1L11.11,18z" />
                        </g>
                    </svg>
                @endcomponent
            </li>
            @if ($user->is_admin)
                <li class="px-4 pt-4 pb-2 uppercase">Admin</li>
                <li>
                    @component('dashboard.layout.partials.sidebardropdownlink',
                        [
                            'title' => 'user',
                            'slug' => 'dashboard/admin/user',
                            'dropdowns' => [
                                ['title' => 'semua', 'slug' => 'dashboard/admin/user'],
                                ['title' => 'user inactive', 'slug' => 'dashboard/admin/user/inactive'],
                            ],
                        ])
                        <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2m0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    @endcomponent
                </li>
            @endif
        </ul>
    </div>
</div>
