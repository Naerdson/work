@extends('admin.layouts.master')
@section('content')
<section class="section-charts">
    <canvas id="demandas" height="72"></canvas>
</section>


@push('scripts')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/charts-ouvidoria.js') }}"></script>
@endpush
@endsection
