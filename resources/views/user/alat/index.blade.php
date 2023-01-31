@extends('user.layouts.main')
@section('container')
    @include('partials.machinetable', [
        'slot' => $alat,
    ])
    <div class="mt-8">
        @include('partials.pagination', ['paginator' => $alat])
    </div>
@endsection
