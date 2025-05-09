@extends('layouts.master')


@section('content')
<div class="">
    <div class="d-flex justify-content-between">
        <h1>Student Dashboard</h1>
        <a href="{{ route('student.attendance.scan') }}" class="btn btn-primary pt-3">Scan Attendance</a>
    </div>
</div>
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

