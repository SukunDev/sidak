@extends('dashboard.layout.main')
@section('container')
    <div class="space-y-8">
        <div class="rounded-md border border-gray-200 px-4 py-2 shadow-md">
            <p class="text-lg font-medium">Info Pengguna</p>
            @error('name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('email')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <form class="space-y-4" action="/{{ Request::path() }}" method="POST">
                @csrf
                <input type="hidden" name="settings" value="ubah_pengguna">
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="usernameForm">username</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="username" id="usernameForm" value="{{ $user->username }}" readonly>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="nameForm">nama</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="text" name="name" id="nameForm" value="{{ $user->name }}" required>
                </div>
                <div class="flex flex-col">
                    <label class="capitalize font-medium" for="emailForm">email</label>
                    <input
                        class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                        type="email" name="email" id="emailForm" value="{{ $user->email }}" required>
                </div>
                <div class="flex justify-center">
                    <button class="w-1/2 py-2 rounded-md bg-green-500 text-white" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="rounded-md border border-gray-200 px-4 py-2 shadow-md">
            <p class="text-lg font-medium">Ubah Sandi</p>
            @error('current_password')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('new_password')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <form action="/{{ Request::path() }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="settings" value="ubah_password">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex flex-col">
                        <label class="capitalize font-medium" for="oldPasswordForm">Password Lama</label>
                        <input
                            class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                            type="password" name="current_password" id="oldPasswordForm" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="capitalize font-medium" for="passwordForm">Password</label>
                        <input
                            class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                            type="password" name="new_password" id="passwordForm" required>
                    </div>
                    <div class="flex flex-col">
                        <label class="capitalize font-medium" for="konfirmPasswordForm">konfirmasi password</label>
                        <input
                            class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                            type="password" name="new_confirm_password" id="konfirmPasswordForm" required>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="w-1/2 py-2 rounded-md bg-green-500 text-white" type="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
