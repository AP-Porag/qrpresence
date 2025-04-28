@extends('layouts.master')


@section('content')
<h1>Dashboard</h1>
@endsection

@push('style')
    @include('includes.styles.datatable')
@endpush

@push('script')
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    {{-- <script src="{{ asset('/admin/js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/js/chartjs.init.js') }}"></script> --}}

    <script>

    </script>
@endpush

