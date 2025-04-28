<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\CourseLesson;
use App\Utils\GlobalConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Models\CompletedStudentCourse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

if (!function_exists('currency_symbol')) {
    function currency_symbol(): string
    {
        return "$";
    }
}

if (!function_exists('seconds_to_hour')) {
    function seconds_to_hour($init)
    {
        $hours = floor($init / 3600);
        $minutes = floor(($init / 60) % 60);

        return $hours . "h " . $minutes . "m";
    }
}

if (!function_exists('feature_string_to_array')) {
    function feature_string_to_array($str)
    {
        return explode('|', $str);
    }
}


if (!function_exists('tag_process_for_front')) {
    function tag_process_for_front($tag_str)
    {
        try {
            $tag_array = tag_string_to_array($tag_str);
            $process_tag = [];
            foreach ($tag_array as $tag) {
                $t = new \stdClass();
                $t->value = $tag;
                $process_tag[] = $t;
            }
            return json_encode($process_tag);
        } catch (Exception $e) {
            log_error($e);
            return '';
        }
    }
}
if (!function_exists('tag_string_to_array')) {
    function tag_string_to_array($str)
    {
        return explode(',', $str);
    }
}


if (!function_exists('tags_to_string')) {
    function tags_to_string($tag_array)
    {
        $all_tags = [];
        try {
            foreach (json_decode($tag_array) as $tag) {
                $all_tags[] = $tag->value;
            }
        } catch (Exception $e) {
            log_error($e);
        }
        return implode(',', $all_tags);
    }
}

function str_title($title)
{
    return Str::title($title);
}

function get_current_route_name()
{
    //    Log::info(Route::current()->getName());
    return Route::current()->getName();
}

if (!function_exists('days_ago_from_now')) {

    function days_ago_from_now($date, $full = false)
    {
        $now = new DateTime();
        $ago = new DateTime($date);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        $data = $string ? implode(', ', $string) . ' ago' : 'just now';
        return $data;
        //        Posted 0 days ago
        //        $earlier = new DateTime(now());
        //        $later = new DateTime($date);
        //
        //        return $later->diff($earlier)->format("%a"); //3
    }
}

if (!function_exists('make_2_digits')) {

    function make_2_digits($num)
    {
        return sprintf('%02d', $num);
    }
}

if (!function_exists('random_number')) {
    function random_number()
    {
        return random_int(100000, 999999);
    }
}


if (!function_exists('str_limit')) {

    function str_limit($string, $limit, $end = '...')
    {
        return Str::limit($string, $limit, $end);
    }
}

if (!function_exists('month_list')) {

    function month_list()
    {
        return [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
    }
}

if (!function_exists('get_storage_image')) {

    function get_storage_image($path, $name, $type = 'normal')
    {
        $full_path = '/storage/' . $path . '/' . $name;
        if ($name) {
            return asset($full_path);
        }
        return get_default_image($type);
    }
}
if (!function_exists('get_storage_file')) {
    function get_storage_file($path, $name)
    {
        $full_path = '/storage/' . $path . '/' . $name;
        if ($name) {
            return asset($full_path);
        }
        return get_default_image();
    }
}

if (!function_exists('get_default_image')) {

    function get_default_image($type = 'normal')
    {
        if ($type == 'user') {
            return asset('/images/user_default.png');
        } elseif ($type == 'normal') {
            return asset('/images/default.png');
        }
    }
}


if (!function_exists('generate_slug')) {
    function generate_slug($value)
    {
        try {
            return preg_replace('/\s+/u', '-', trim($value));
        } catch (\Exception $e) {
            return '';
        }
    }
}
if (!function_exists('record_custom_flash')) {

    function record_custom_flash($message = null)
    {
        Session::flash('custom', $message ?? 'Record modified successfully');
    }
}

if (!function_exists('message_send_flash')) {

    function message_send_flash($message = null)
    {
        Session::flash('message', $message ?? 'Your message was sent successfully');
    }
}

if (!function_exists('record_created_flash')) {

    function record_created_flash($message = null)
    {
        Session::flash('success', $message ?? 'Record created successfully');
    }
}

if (!function_exists('record_updated_flash')) {

    function record_updated_flash($message = null)
    {
        Session::flash('update', $message ?? 'Record updated successfully');
    }
}

if (!function_exists('record_verified_flash')) {

    function record_verified_flash($message = null)
    {
        Session::flash('verified', $message ?? 'Record updated successfully');
    }
}

if (!function_exists('file_uploaded_flash')) {

    function file_uploaded_flash($message = null)
    {
        Session::flash('file_uploaded', $message ?? 'Record updated successfully');
    }
}

if (!function_exists('record_deleted_flash')) {

    function record_deleted_flash($message = null)
    {
        Session::flash('delete', $message ?? 'Record deleted successfully');
    }
}

if (!function_exists('something_wrong_flash')) {

    function something_wrong_flash($message = null)
    {
        Session::flash('error', $message ?? 'Something is wrong!');
    }
}

if (!function_exists('custom_flash')) {

    function custom_flash($title = null, $message = null)
    {
        Session::flash('custom_title', $title);
        Session::flash('custom_message', $message);
    }
}

if (!function_exists('log_error')) {

    function log_error(\Exception $e)
    {
        Log::error($e->getMessage());
    }
}

if (!function_exists('get_page_meta')) {

    function get_page_meta($metaName = "title", $raw = false)
    {
        if (session()->has('page_meta_' . $metaName)) {
            $title = session()->get("page_meta_" . $metaName);
            //            session()->forget("page_meta_" . $metaName);
            if ($raw) {
                return str_replace(' |', '', $title);
            } else {
                return $title;
            }
        }
        return null;
    }
}

if (!function_exists('set_page_meta')) {

    function set_page_meta($content = null, $metaName = "title")
    {
        if ($content && $metaName == "title") {
            session()->put('page_meta_' . $metaName, $content . ' |');
        } else {
            session()->put('page_meta_' . $metaName, $content);
        }
    }
}
if (!function_exists('custom_datetime')) {

    function custom_datetime($datetime, $format = null)
    {
        if ($format) {
            return date($format, strtotime($datetime));
        }

        return date('M j, Y, g:i A', strtotime($datetime));
    }
}

if (!function_exists('custom_date')) {

    function custom_date($datetime, $format = null)
    {
        if ($format) {
            return date($format, strtotime($datetime));
        }

        return date('M j, Y', strtotime($datetime));
    }
}

if (!function_exists('user_fullname')) {

    function user_fullname($user)
    {
        if ($user->user_type == User::USER_TYPE_COMPANY) {
            return $user->company_name;
        } else {
            if ($user->middle_name) {
                return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
            } else {
                return $user->first_name . ' ' . $user->last_name;
            }
        }
    }
}

if (!function_exists('work_study_year_showing')) {

    function work_study_year_showing($data)
    {
        if ($data->start_date && $data->end_date) {
            $start = explode("-", $data->start_date);
            $end = explode("-", $data->end_date);
            return $start[0] . ' - ' . $end[0];
        } elseif ($data->start_date && $data->is_present) {
            $start = explode("-", $data->start_date);
            return $start[0] . ' - Present ';
        } else {
            return 'N/A';
        }
    }
}



if (!function_exists('show_company_type')) {

    function show_company_type($type)
    {
        if ($type == 'sponsorship') {
            return 'Sponsorship';
        } elseif ($type == 'seeking-students') {
            return 'Seeking Students';
        } elseif ($type == 'event') {
            return 'Host Events / Seminars';
        } else {
            return '';
        }
    }
}


if (!function_exists('getImage')) {
    function getImage($image = null, $type = null)
    {
        if ($image && Storage::disk('public')->exists($image)) {
            return Storage::disk('public')->url($image);
        } else {
            return asset('/images/default.png');
        }
    }
}

if (!function_exists('show_company_name')) {

    function show_company_name($user_id)
    {
        $user =  User::where('id', $user_id)->select('id', 'first_name', 'last_name', 'company_name')->first();
        return $user->company_name;
    }
}

if (!function_exists('show_limited_string')) {

    function show_limited_string($str, $length)
    {
        return strlen($str) > $length ? substr($str, 0, $length) . "..." : $str;
    }
}

if (!function_exists('course_progress_pecentage')) {

    function course_progress_pecentage($course_id)
    {
        $percentage = 0;
        $completd = CompletedStudentCourse::where(['course_id' => $course_id, 'student_id' => auth()->id()])->count();
        $total = CourseLesson::where('course_id', $course_id)->count();

        if ($total > 0 && $completd > 0) {
            $percentage = round(($completd / $total) * 100);
        }
        return $percentage;
    }
}

if (!function_exists('is_completd_lesson')) {

    function is_completd_lesson($cid, $mid, $lid)
    {
        $found = CompletedStudentCourse::where(['course_id' => $cid, 'module_id' => $mid, 'lesson_id' => $lid, 'student_id' => auth()->id()])->first();
        if ($found) {
            return true;
        }
        return false;
    }
}

if (!function_exists('commission')) {

    function commission($fee_amount, $total_attendee)
    {
        $commission = round((($fee_amount * $total_attendee) * Config('settings.system_COMMISSION')) / 100, 2);

        return $commission;
    }
}

if (!function_exists('is_published_course')) {

    function is_published_course($course_id)
    {
        return Course::where('id', $course_id)->whereStatus('pending')->first();
    }
}
