@extends('dashboard.layout.main')
@section('container')
    @include('dashboard.layout.partials.machinetable', [
        'slot' => $alat,
    ])
    <div class="mt-8">
        @include('dashboard.layout.partials.pagination', ['paginator' => $alat])
    </div>
@endsection
