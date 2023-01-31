@extends('admin.layouts.main')
@section('container')
    <div>
        <button id="show-modal-tambah-user"
            class="px-6 py-2 rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white capitalize">Tambah
            User</button>
    </div>
    @component('admin.layouts.partials.userlist', ['all_user' => $all_user])
    @endcomponent
    <div class="mt-8">
        @include('partials.pagination', ['paginator' => $all_user])
    </div>
    @include('admin.layouts.partials.modaltambahuser')
@endsection
