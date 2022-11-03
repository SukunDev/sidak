@extends('dashboard.layout.main')
@section('container')
    <div class="px-4 py-4 rounded-md bg-white shadow-md">
        <form class="space-y-4" action="/{{ Request::path() }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="namaAlatForm">nama alat</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="nama_alat" id="namaALatForm" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="merkForm">merk</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="merk" id="merkForm" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="typeForm">type</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="type" id="typeForm" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="spesifikasiForm">spesifikasi</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="spesifikasi" id="spesifikasiForm" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="lokasiForm">lokasi</label>
                <select
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    name="lokasi" id="lokasiForm">
                    <option value="Lab. Houshould">Lab. Houshould</option>
                    <option value="Lab. Audio Video">Lab. Audio Video</option>
                    <option value="Lab. EMC">Lab. EMC</option>
                    <option value="Lab Radio Frequency">Lab Radio Frequency</option>
                    <option value="Lab. AC">Lab. AC</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="noSeriForm">no. seri</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="no_seri" id="noSeriForm" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="kodeAlatForm">kode alat</label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="text" name="kode_alat" id="kodeAlatForm" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="siklusKalibrasiForm">siklus kalibrasi <span
                        class="text-sm font-normal text-gray-500 normal-case">(dalam
                        bulan)</span></label>
                <input
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    type="number" name="siklus_kalibrasi" id="siklusKalibrasiForm" value="0" required>
            </div>
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="keteranganForm">keterangan</label>
                <textarea
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    name="keterangan" id="keteranganForm" rows="3"></textarea>
            </div>
            <div class="flex justify-center">
                <button class="w-1/2 py-2 rounded-md bg-green-500 text-white" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
