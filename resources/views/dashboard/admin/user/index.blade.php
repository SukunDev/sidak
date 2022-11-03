@extends('dashboard.layout.main')
@section('container')
    @if (Request::path() == 'dashboard/admin/user')
        <div>
            <button id="show-modal-tambah-user"
                class="px-6 py-2 rounded-md bg-green-500 hover:bg-green-600 active:bg-green-500 transition duration-300 text-white capitalize">Tambah
                User</button>
        </div>
    @endif
    @component('dashboard.layout.partials.userlist', ['all_user' => $all_user])
    @endcomponent
    <div class="mt-8">
        @include('dashboard.layout.partials.pagination', ['paginator' => $all_user])
    </div>
    @include('dashboard.layout.partials.modaltambahuser')
@endsection
