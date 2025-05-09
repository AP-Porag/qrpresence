@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Scan Attendance QR</h4>
                    <div class="text-center">
                        <div id="reader" style="width: 300px; height: 300px; margin: auto;"></div>
                        <div id="qr-result" class="mt-3 text-success"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const qrCodeRegionId = "reader";
            const html5QrCode = new Html5Qrcode(qrCodeRegionId);

            function onScanSuccess(qrCodeMessage) {
                document.getElementById('qr-result').innerText = `Scanned: ${qrCodeMessage}`;

                html5QrCode.stop(); // Stop scanning after successful scan

                navigator.geolocation.getCurrentPosition(function (pos) {
                    fetch("{{ route('student.attendance.submit') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            qr_code: qrCodeMessage,
                            lat: pos.coords.latitude,
                            lng: pos.coords.longitude
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert(data.message);
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            }
                        });
                });
            }

            function onScanFailure(error) {
                // Handle scan failure silently
            }

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    html5QrCode.start(
                        devices[0].id,
                        {
                            fps: 10,
                            qrbox: 250
                        },
                        onScanSuccess,
                        onScanFailure
                    );
                } else {
                    alert("No camera found or permission denied.");
                }
            }).catch(err => {
                console.error("Camera error: ", err);
                alert("Failed to access camera.");
            });
        });
    </script>
@endpush
