@extends('admin.layouts.main')
@section('container')
    <div class="flex flex-wrap justify-end items-center gap-2 mt-4 text-xs">
        <form action="/{{ Request::path() }}/status" method="POST">
            @csrf
            <input type="hidden" name="status" value="{{ $user_detail->active > 0 ? 'nonactive' : 'active' }}">
            <button type="submit"
                class="px-3 py-1.5 rounded-md text-white {{ $user_detail->active > 0 ? 'bg-red-500 hover:bg-red-600 active:bg-red-500' : 'bg-green-500 hover:bg-green-600 active:bg-green-500' }} transition duration-300 capitalize">
                {{ $user_detail->active > 0 ? 'non aktifkan' : 'aktifkan' }}
            </button>
        </form>
        <a onclick="return confirm('Apakah anda yakin ingin menghapus {{ $user_detail->name }}?')"
            class="px-2 py-1 rounded-md text-white bg-gray-500 hover:bg-gray-600 active:bg-gray-500 transition duration-300 capitalize"
            href="/admin/user/{{ $user_detail->id }}/hapus">Hapus</a>
    </div>
    <div class="rounded-md shadow-md bg-white">
        @component('partials.detailcard',
            [
                'items' => [
                    ['key' => 'nama lengkap', 'value' => $user_detail->name],
                    ['key' => 'username', 'value' => $user_detail->username],
                    [
                        'key' => 'email',
                        'value' => $user_detail->email ? $user_detail->email : 'Pengguna Belum Menyiapkan Email',
                    ],
                    [
                        'key' => 'status',
                        'value' =>
                            $user_detail->active > 0
                                ? '<span class="px-4 py-0.5 rounded-md bg-green-500 text-white">Aktif</span>'
                                : '<span class="px-4 py-0.5 rounded-md bg-red-500 text-white">Non Aktif</span>',
                    ],
                ],
            ])
        @endcomponent
    </div>
@endsection
