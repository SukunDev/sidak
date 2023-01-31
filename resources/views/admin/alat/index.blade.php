@extends('admin.layouts.main')
@section('container')
    <div>
        <a href="/admin/alat/new"
            class="px-6 py-2 rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white capitalize">Tambah
            Alat</a>
    </div>
    @include('partials.machinetable', [
        'slot' => $alat,
    ])
    <div class="mt-8">
        @include('partials.pagination', ['paginator' => $alat])
    </div>
@endsection
