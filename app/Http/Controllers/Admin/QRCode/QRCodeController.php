<?php

namespace App\Http\Controllers\Admin\QRCode;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\QCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generate($courseId) {
        $token = Str::random(16);
//        $expiresAt = now()->addMinutes(15);
        $expiresAt = now()->addDays(1);

        $qr = QCode::create([
            'course_id' => $courseId,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        record_created_flash();
        return redirect()->route('instructor.courses.index');

//        $url = route('instructor.attendance.scan', ['token' => $token]);
//        $qrCode = QrCode::size(300)->generate($url);
//
//        return view('admin.qrcode.index', compact('qrCode'));
    }

    public function show($id)
    {

        try {
            $token = QCode::where('course_id', $id)->where('expires_at', '>', now())->first()->token;
            $url = route('student.attendance.scan', ['token' => $token]);
            $qrCode = QrCode::size(300)->generate($url);

            return view('admin.qrcode.index', compact('qrCode'));

        } catch (\Throwable $th) {
            return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>QR Code Error</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    background-color: #f8f9fa;
                }
                .container {
                    text-align: center;
                    padding: 30px;
                    border: 1px solid #ddd;
                    background-color: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                .btn-custom {
                    margin-top: 20px;
                    background-color: #dc3545;
                    color: white;
                    border: none;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1 class="display-4 text-danger">Invalid QR Code OR Expired QR Code</h1>
                <p class="lead">Please ask your instructor to re-create one.</p>
                <button class="btn btn-custom" onclick="window.history.back()">Go Back</button>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
    ';
        }
    }

    public function scanPage()
    {
        return view('student.attendance.index'); // Blade file for camera scanner
    }

    public function submit(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        // Extract token from full URL
        $qrCodeUrl = $request->input('qr_code');
        $parsedUrl = parse_url($qrCodeUrl);
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        $token = $queryParams['token'] ?? null;

        if (!$token) {
            return response()->json(['message' => 'Invalid QR code. Token missing.'], 400);
        }

        $qr = QCode::where('token', $token)->whereDate('created_at', Carbon::today())->first();

        if (!$qr) {
            return response()->json(['message' => 'Invalid or expired QR code.'], 400);
        }

        $instructor_id = Course::where('id', $qr->course_id)->value('instructor_id');

        // OPTIONAL: Location check — must be within 2km
        $campusLat = 12.345678;
        $campusLng = 98.765432;
        $distance = $this->calculateDistance($campusLat, $campusLng, $request->lat, $request->lng);

        // if ($distance > 2) {
        //     return response()->json(['message' => 'You must be near campus to mark attendance.'], 400);
        // }

        // Save attendance
        Attendance::create([
            'student_id' => Auth::id(),
            'course_id' => $qr->course_id,
            'instructor_id' => $instructor_id,
            'scanned_at' => Carbon::today(),
            'distance' => $distance,
        ]);

        return response()->json([
            'message' => 'Attendance marked successfully!',
            'redirect' => route('home')
        ]);
    }

    // Helper method for distance (Haversine formula)
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }
}
