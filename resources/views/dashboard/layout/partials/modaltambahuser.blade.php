<div id="modal-tambah-user" style="display: none">
    <div class="fixed inset-0 bg-black opacity-70 z-[9999]">
    </div>
    <div class="fixed inset-0 m-auto  w-[calc(100%-24px)] md:w-[calc(100%-16rem)] lg:w-1/2 h-fit z-[9999]">
        <div class="w-full px-6 py-6 rounded-md bg-white border border-gray-200">
            <div class="flex items-center justify-between">
                <p class="text-xl font-medium">Tambah User</p>
                <button id="modal-tambah-user-close"
                    class="text-gray-400 hover:text-gray-500 active:text-gray-400 transition duration-300">
                    <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </button>
            </div>
            <form class="space-y-4" action="/{{ Request::path() }}/tambah-user" method="POST">
                @csrf
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="nameForm">nama lengkap</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="name" id="nameForm" required>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="usernameForm">username <span
                            class="lowercase text-xs text-gray-500">(min 5 karakter)</span></label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="username" id="usernameForm" required>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="passwordForm">password <span
                            class="lowercase text-xs text-gray-500">(min 6 karakter)</span></label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="password" name="password" id="passwordForm" required>
                </div>
                <div class="flex justify-center">
                    <button
                        class="w-1/2 py-2 rounded-md bg-green-500 text-white hover:bg-green-600 active:bg-green-500 transition duration-300">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
