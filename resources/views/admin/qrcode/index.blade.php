@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Scan to Record Attendance</h4>
                    </div>
                    {!! $qrCode !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
@endpush

@push('script')
@endpush
