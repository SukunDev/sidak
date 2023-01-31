<div class="sticky inset-x-0 top-0 z-[55] bg-white">
    <div class="flex flex-col space-y-3 md:space-y-0 px-4 md:px-8 py-[9px] border border-gray-200">
        <div class="flex md:hidden items-center justify-between text-gray-500">
            <button id="sidebar-mobile-button">
                <svg class="w-7 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <svg class="w-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M392.8 1.2c-17-4.9-34.7 5-39.6 22l-128 448c-4.9 17 5 34.7 22 39.6s34.7-5 39.6-22l128-448c4.9-17-5-34.7-22-39.6zm80.6 120.1c-12.5 12.5-12.5 32.8 0 45.3L562.7 256l-89.4 89.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l112-112c12.5-12.5 12.5-32.8 0-45.3l-112-112c-12.5-12.5-32.8-12.5-45.3 0zm-306.7 0c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3l112 112c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256l89.4-89.4c12.5-12.5 12.5-32.8 0-45.3z" />
                </svg>
                <p class="sidebar-item text-lg">Sidak</p>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <button id="search-button" class="px-2 py-2 block sm:hidden">
                <svg class="w-6 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                </svg>
            </button>
            <form class="hidden sm:block" action="/{{ Request::is('dashboard') ? 'dashboard' : 'dashboard/alat' }}"
                method="GET">
                <div class="flex items-center">
                    <button type="submit" class="px-2 py-2 rounded-l-md bg-sky-100">
                        <svg class="w-6 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                        </svg>
                    </button>
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input
                        class="searchForm px-4 py-2 rounded-r-md bg-sky-100 focus:outline-none focus:ring-sky-200 focus:ring-2 transition duration-300 placeholder:text-gray-400 placeholder:font-light"
                        type="text" name="search" value="{{ request('search') }}" placeholder="Search...">
                </div>
            </form>
            <div class="flex items-center gap-6">
                <button id="notification-button"
                    class="relative text-gray-400 hover:text-gray-500 active:text-gray-400 transition duration-300">
                    <svg class="w-7 fill-current" xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
                    </svg>
                    @php
                        $isNotificationAvailble = false;
                        foreach (
                            App\Models\Notification::orderBy('created_at', 'DESC')
                                ->get()
                                ->take(6)
                            as $item
                        ) {
                            if ($item->usernotifications->where('user_id', $user->id)->count() < 1) {
                                $isNotificationAvailble = true;
                            }
                        }
                    @endphp
                    @if ($isNotificationAvailble)
                        <span class="top-0 left-0.5 absolute px-1.5 py-1.5 rounded-full bg-red-400 animate-pulse">
                        </span>
                    @endif
                </button>
                <button id="profile-button">
                    <img class="w-10" src="/img/user-profile.png" alt="User Profile">
                </button>
                @component('admin.layouts.partials.notificationpanel', ['user' => $user])
                @endcomponent
                @include('admin.layouts.partials.profilepanel')
                <div id="searchPanel" class="fixed top-[100px] md:top-[60px] inset-x-4 md:right-auto md:left-[17rem]"
                    style="display: none">
                    <div class="w-full md:w-[29rem] rounded-md bg-white shadow-md border border-gray-200">
                        <form class="block sm:hidden"
                            action="/{{ Request::is('dashboard') ? 'dashboard' : 'dashboard/alat' }}" method="GET">
                            <div class="flex items-center">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                                <input
                                    class="searchForm w-full px-4 py-2 rounded-t-md bg-sky-100 focus:outline-none focus:ring-sky-200 focus:ring-2 transition duration-300 placeholder:text-gray-400 placeholder:font-light"
                                    type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search...">
                            </div>
                        </form>
                        <ul>
                            <li class="hidden">
                                <a class="flex items-end gap-2 px-4 py-2 rounded-md hover:bg-gray-100 font-medium text-gray-600 hover:font-normal hover:text-gray-700"
                                    href=""><svg class="w-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                                    </svg></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
