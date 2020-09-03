@extends('admin.layouts.master')
@section('content')

<div class="row mt-3">
        {{-- Demandas --}}
        <div class="col-md-6">
            <canvas id="demandas"></canvas>
        </div>
        {{-- /Demandas --}}
        
        {{-- Demandantes --}}
        <div class="col-md-6">
            <canvas id="demandantes"></canvas>
        </div>
        {{-- Plataforma --}}
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/charts-ouvidoria.js') }}"></script>
@endpush
@endsection
