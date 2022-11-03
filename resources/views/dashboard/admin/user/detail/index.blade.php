@extends('dashboard.layout.main')
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
    </div>
    <div class="rounded-md shadow-md bg-white">
        @component('dashboard.layout.partials.detailcard',
            [
                'items' => [
                    ['key' => 'nama lengkap', 'value' => $user_detail->name],
                    ['key' => 'username', 'value' => $user_detail->username],
                    [
                        'key' => 'email',
                        'value' => $user_detail->email ? $user_detail->email : 'Pengguna Belum Menyiapkan Email',
                    ],
                    ['key' => 'jumlah alat', 'value' => $user_detail->alat->count()],
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
    @include('dashboard.layout.partials.machinetable', [
        'slot' => $user_alat,
        'filter' => 'false',
    ])
@endsection
