@extends('dashboard.layout.main')
@section('container')
    <div class="px-4 py-4 rounded-md bg-white shadow-md">
        <form class="space-y-4" action="/{{ Request::path() }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="namaAlatForm">nama alat</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="nama_alat" id="namaALatForm" value="{{ $alat->nama_alat }}" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="merkForm">merk</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="merk" id="merkForm" value="{{ $alat->merk }}" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="typeForm">type</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="type" id="typeForm" value="{{ $alat->type }}" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="spesifikasiForm">spesifikasi</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="spesifikasi" id="spesifikasiForm" value="{{ $alat->spesifikasi }}" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="lokasiForm">lokasi</label>
                <select
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    name="lokasi" id="lokasiForm">
                    <option value="Lab. Household" {{ $alat->lokasi == 'Lab. Household' ? 'selected' : '' }}>Lab. Household
                    </option>
                    <option value="Lab. Audio Video" {{ $alat->lokasi == 'Lab. Audio Video' ? 'selected' : '' }}>Lab. Audio
                        Video</option>
                    <option value="Lab. EMC" {{ $alat->lokasi == 'Lab. EMC' ? 'selected' : '' }}>Lab. EMC</option>
                    <option value="Lab Radio Frequency" {{ $alat->lokasi == 'Lab Radio Frequency' ? 'selected' : '' }}>Lab
                        Radio Frequency</option>
                    <option value="Lab. AC" {{ $alat->lokasi == 'Lab. AC' ? 'selected' : '' }}>Lab. AC</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="noSeriForm">no. seri</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="no_seri" id="noSeriForm" value="{{ $alat->no_seri }}" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="kodeAlatForm">kode alat</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="kode_alat" id="kodeAlatForm" value="{{ $alat->kode_alat }}" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="siklusKalibrasiForm">siklus kalibrasi <span
                        class="text-sm font-normal text-gray-500 normal-case">(dalam
                        bulan)</span></label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="number" name="siklus_kalibrasi" id="siklusKalibrasiForm" value="{{ $alat->siklus_kalibrasi }}"
                    required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="keteranganForm">keterangan</label>
                <textarea
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    name="keterangan" id="keteranganForm" rows="3">{{ $alat->keterangan }}</textarea>
            </div>
            <div class="flex justify-center">
                <button class="w-1/2 py-2 rounded-md bg-green-500 text-white" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
