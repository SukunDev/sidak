@extends('dashboard.layout.main')
@section('container')
    <div class="flex flex-wrap justify-end items-center gap-2 mt-4 text-xs">
        @if ($detail->jadwal->where('status', 'jadwal baru')->count() < 1 &&
            $detail->jadwal->where('status', 'kadaluarsa')->count() < 1)
            <button id="show-modal-tambah-jadwal"
                class="px-3 py-1.5 rounded-md bg-green-500 text-white hover:bg-green-600 active:bg-green-500 transition duration-300">Tambah
                Jadwal</button>
        @endif
        <a href="/dashboard/alat/{{ $detail->id }}/edit"
            class="px-3 py-1.5 rounded-md bg-blue-500 text-white hover:bg-blue-600 active:bg-blue-500 transition duration-300">Edit</a>
        <button id="show-modal-file-manager"
            class="px-3 py-1.5 rounded-md bg-slate-500 text-white hover:bg-slate-600 active:bg-slate-500 transition duration-300">Upload
            Image</button>
        <button data-id="{{ $detail->id }}" id="show-modal-hapus-alat"
            class="px-3 py-1.5 rounded-md bg-red-500 text-white hover:bg-red-600 active:bg-red-500 transition duration-300">Hapus</button>
    </div>
    <div class="rounded-md shadow-md bg-white">
        <div class="flex flex-col lg:flex-row items-start">
            @component('dashboard.layout.partials.imageslider',
                [
                    'image' => $detail->images,
                ])
            @endcomponent
            @component('dashboard.layout.partials.detailcard',
                [
                    'items' => [
                        ['key' => 'nama alat', 'value' => $detail->nama_alat],
                        ['key' => 'merk', 'value' => $detail->merk],
                        ['key' => 'type', 'value' => $detail->type],
                        ['key' => 'Spesifikasi', 'value' => $detail->spesifikasi],
                        ['key' => 'Lokasi', 'value' => $detail->lokasi],
                        ['key' => 'no. seri', 'value' => $detail->no_seri],
                        ['key' => 'kode alat', 'value' => $detail->kode_alat],
                        [
                            'key' => 'siklus kalibrasi',
                            'value' => $detail->siklus_kalibrasi < 1 ? '-' : $detail->siklus_kalibrasi . ' bulan',
                        ],
                        [
                            'key' => 'status kalibrasi',
                            'value' => $detail->status_kalibrasi
                                ? '<span class="px-2 py-1 rounded-md ' .
                                    ($detail->status_kalibrasi === 'sudah terkalibrasi'
                                        ? 'bg-green-500'
                                        : ($detail->status_kalibrasi === 'kadaluarsa'
                                            ? 'bg-red-500'
                                            : 'bg-blue-500')) .
                                    ' text-white capitalize">' .
                                    $detail->status_kalibrasi .
                                    '</span>'
                                : 'belum ada catatan',
                        ],
                        [
                            'key' => 'Kalibrasi Terakhir',
                            'value' =>
                                $detail->jadwal->where('status', 'sudah terkalibrasi')->count() > 0
                                    ? Carbon\Carbon::parse(
                                        $detail->jadwal->where('status', 'sudah terkalibrasi')->first()->jadwal_kalibrasi)->format('d, F Y')
                                    : 'belum ada catatan',
                        ],
                        [
                            'key' => 'Kalibrasi Selanjutnya',
                            'value' =>
                                $detail->jadwal->where('status', '!=', 'sudah terkalibrasi')->count() > 0
                                    ? Carbon\Carbon::parse(
                                        $detail->jadwal->where('status', '!=', 'sudah terkalibrasi')->first()->jadwal_kalibrasi)->format('d, F Y')
                                    : 'belum ada catatan',
                        ],
                        ['key' => 'keterangan', 'value' => $detail->keterangan],
                    ],
                ])
            @endcomponent
        </div>
    </div>
    @if ($detail->jadwal->count() > 0 && $detail->jadwal->where('status', '!=', 'sudah terkalibrasi')->count() > 0)
        <div class="flex items-center gap-4">
            <button
                class="px-6 py-2 rounded-md bg-green-500 text-white hover:bg-green-600 active:bg-green-500 transition duration-300"
                id="show-modal-sudah-terkalibrasi">Sudah
                Terkalibrasi</button>
            <a href="/{{ Request::path() }}/hapus-jadwal"
                class="px-6 py-2 rounded-md bg-red-500 text-white hover:bg-red-600 active:bg-red-500 transition duration-300">Hapus</a>
        </div>
    @endif
    @component('dashboard.layout.partials.historytable', ['detail' => $history])
    @endcomponent
    @component('dashboard.layout.partials.modalwarning')
    @endcomponent
    @component('dashboard.layout.partials.imageuploader', ['detail' => $detail, 'user' => $user])
    @endcomponent
    @component('dashboard.layout.partials.tambahjadwalmodal', ['detail' => $detail])
    @endcomponent
    @component('dashboard.layout.partials.sudahterkalibrasimodal', ['detail' => $detail])
    @endcomponent
    @include('dashboard.layout.partials.uploadsertifikat')
@endsection
