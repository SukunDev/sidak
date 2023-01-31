@extends('user.layouts.main')
@section('container')
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
    @component('partials.historytable', ['detail' => $history])
    @endcomponent
    @component('partials.modalwarning')
    @endcomponent
@endsection
