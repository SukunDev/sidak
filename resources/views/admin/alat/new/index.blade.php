@extends('admin.layouts.main')
@section('container')
    <div class="px-4 py-4 rounded-md bg-white shadow-md">
        <form class="space-y-4" action="/{{ Request::path() }}" method="POST">
            @csrf
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'nama_alat',
                    'label' => 'nama alat',
                    'id' => 'namaALatForm',
                    'type' => 'text',
                    'value' => old('nama_alat'),
                    'required' => 'true',
                ])
            @endcomponent
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'merk',
                    'label' => 'merk',
                    'id' => 'merkForm',
                    'type' => 'text',
                    'value' => old('merk'),
                    'required' => 'true',
                ])
            @endcomponent
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'type',
                    'label' => 'type',
                    'id' => 'typeForm',
                    'type' => 'text',
                    'value' => old('type'),
                    'required' => 'true',
                ])
            @endcomponent
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'spesifikasi',
                    'label' => 'spesifikasi',
                    'id' => 'spesifikasiForm',
                    'type' => 'text',
                    'value' => old('spesifikasi'),
                    'required' => 'true',
                ])
            @endcomponent
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="lokasiForm">lokasi</label>
                <select
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    name="lokasi" id="lokasiForm">
                    @foreach (json_decode(App\Helpers\AppHelper::instance()->getOptions('lokasi_lab')) as $lab)
                        <option value="{{ $lab }}">{{ $lab }}</option>
                    @endforeach
                </select>
            </div>
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'no_seri',
                    'label' => 'no. seri',
                    'id' => 'noSeriForm',
                    'type' => 'text',
                    'value' => old('no_seri'),
                    'required' => 'true',
                ])
            @endcomponent
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'kode_alat',
                    'label' => 'kode alat',
                    'id' => 'kodeAlatForm',
                    'type' => 'text',
                    'value' => old('kode_alat'),
                    'required' => 'true',
                ])
            @endcomponent
            @component('admin.layouts.partials.form.input',
                [
                    'name' => 'siklus_kalibrasi',
                    'label' => 'siklus kalibrasi <span class="text-sm font-normal text-gray-500 normal-case">(dalam bulan)</span>',
                    'id' => 'siklusKalibrasiForm',
                    'type' => 'number',
                    'value' => old('siklus_kalibrasi') ? old('siklus_kalibrasi') : '0',
                    'required' => 'true',
                ])
            @endcomponent
            <div class="flex flex-col">
                <label class="capitalize font-medium" for="keteranganForm">keterangan</label>
                <textarea
                    class="px-4 py-2 rounded-md bg-gray-200 focus:outline-gray-200 focus:bg-white focus:shadow-md transition duration-300"
                    name="keterangan" id="keteranganForm" rows="3" required></textarea>
            </div>
            <div class="flex justify-center">
                <button class="w-1/2 py-2 rounded-md bg-green-500 text-white" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
