@extends('admin.layouts.main')
@section('container')
    <div class="flex flex-wrap justify-end items-center gap-2 mt-4 text-xs">
        @if ($alat->jadwal->where('status', 'jadwal baru')->count() < 1 &&
            $alat->jadwal->where('status', 'kadaluarsa')->count() < 1)
            <button id="show-modal-tambah-jadwal"
                class="px-3 py-1.5 rounded-md bg-green-500 text-white hover:bg-green-600 active:bg-green-500 transition duration-300">Tambah
                Jadwal</button>
        @endif
        <a href="/admin/alat/edit/{{ $alat->id }}"
            class="px-3 py-1.5 rounded-md bg-blue-500 text-white hover:bg-blue-600 active:bg-blue-500 transition duration-300">Edit</a>
        <button id="show-modal-file-manager"
            class="px-3 py-1.5 rounded-md bg-slate-500 text-white hover:bg-slate-600 active:bg-slate-500 transition duration-300">Upload
            Image</button>
        <button data-id="{{ $alat->id }}" id="show-modal-hapus-alat"
            class="px-3 py-1.5 rounded-md bg-red-500 text-white hover:bg-red-600 active:bg-red-500 transition duration-300">Hapus</button>
    </div>
    <div class="rounded-md shadow-md bg-white">
        <div class="flex flex-col lg:flex-row items-start">
            @component('partials.imageslider',
                [
                    'image' => $alat->images,
                ])
            @endcomponent
            @component('partials.detailcard',
                [
                    'items' => [
                        ['key' => 'nama alat', 'value' => $alat->nama_alat],
                        ['key' => 'merk', 'value' => $alat->merk],
                        ['key' => 'type', 'value' => $alat->type],
                        ['key' => 'Spesifikasi', 'value' => $alat->spesifikasi],
                        ['key' => 'Lokasi', 'value' => $alat->lokasi],
                        ['key' => 'no. seri', 'value' => $alat->no_seri],
                        ['key' => 'kode alat', 'value' => $alat->kode_alat],
                        [
                            'key' => 'siklus kalibrasi',
                            'value' => $alat->siklus_kalibrasi < 1 ? '-' : $alat->siklus_kalibrasi . ' bulan',
                        ],
                        [
                            'key' => 'status kalibrasi',
                            'value' => $alat->status_kalibrasi
                                ? '<span class="px-2 py-1 rounded-md whitespace-nowrap ' .
                                    ($alat->status_kalibrasi === 'sudah terkalibrasi'
                                        ? 'bg-green-500'
                                        : ($alat->status_kalibrasi === 'kadaluarsa'
                                            ? 'bg-red-500'
                                            : ($alat->status_kalibrasi === 'persiapan kalibrasi'
                                                ? 'bg-blue-500'
                                                : 'bg-gray-500'))) .
                                    ' text-white capitalize">' .
                                    $alat->status_kalibrasi .
                                    '</span>'
                                : 'belum ada catatan',
                        ],
                        [
                            'key' => 'Kalibrasi Terakhir',
                            'value' =>
                                $alat->jadwal->where('status', 'sudah terkalibrasi')->count() > 0
                                    ? Carbon\Carbon::parse(
                                        $alat->jadwal->where('status', 'sudah terkalibrasi')->first()->jadwal_kalibrasi)->format('d, F Y')
                                    : 'belum ada catatan',
                        ],
                        [
                            'key' => 'Kalibrasi Selanjutnya',
                            'value' =>
                                $alat->jadwal->where('status', '!=', 'sudah terkalibrasi')->count() > 0
                                    ? Carbon\Carbon::parse(
                                        $alat->jadwal->where('status', '!=', 'sudah terkalibrasi')->first()->jadwal_kalibrasi)->format('d, F Y')
                                    : 'belum ada catatan',
                        ],
                        ['key' => 'keterangan', 'value' => $alat->keterangan],
                    ],
                ])
            @endcomponent
        </div>
    </div>
    @if ($alat->jadwal->count() > 0 && $alat->jadwal->where('status', '!=', 'sudah terkalibrasi')->count() > 0)
        <div class="flex items-center gap-4">
            <button
                class="px-6 py-2 rounded-md bg-green-500 text-white hover:bg-green-600 active:bg-green-500 transition duration-300"
                id="show-modal-sudah-terkalibrasi">Sudah
                Terkalibrasi</button>
            <a href="/{{ Request::path() }}/hapus-jadwal"
                class="px-6 py-2 rounded-md bg-red-500 text-white hover:bg-red-600 active:bg-red-500 transition duration-300">Hapus</a>
        </div>
    @endif
    @component('partials.historytable', ['detail' => $history])
    @endcomponent
    @component('partials.modalwarning')
    @endcomponent
    @component('admin.layouts.partials.imageuploader', ['detail' => $alat, 'user' => $user])
    @endcomponent
    @component('admin.layouts.partials.tambahjadwalmodal', ['detail' => $alat])
    @endcomponent
    @component('admin.layouts.partials.sudahterkalibrasimodal', ['detail' => $alat])
    @endcomponent
    @include('admin.layouts.partials.uploadsertifikat')
@endsection
