@extends('layouts.master')


@section('content')
<div class="">
    <div class="d-flex justify-content-between">
        <h1>Student Dashboard</h1>
        <a href="{{ route('student.attendance.scan') }}" class="btn btn-primary pt-3">Scan Attendance</a>
    </div>
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="card-title mb-3">Attendance</h4>
            {!! $dataTable->table(['class'=>'table-responsive']) !!}
        </div>
    </div>
</div>
@endsection

@push('style')
    @include('includes.styles.datatable')
@endpush

@push('script')
    @include('includes.scripts.datatable')
@endpush

