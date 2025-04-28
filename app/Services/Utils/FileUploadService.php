<?php

namespace App\Services\Utils;

use Exception;

class FileUploadService
{
    public function uploadFile($file, $upload_path = null, $delete_path = null, $use_original_name = false, $add_time_to_name = true)
    {
        try {
            // Delete old file
            if ($delete_path) {
                $this->delete($delete_path);
            }
            // Upload new file
            return $this->upload($file, $upload_path, $use_original_name, $add_time_to_name);
        } catch (Exception $ex) {
            return null;
        }
    }

    public function upload($file, $path = 'others', $use_original_name = false, $add_time_to_name = true)
    {
        try {
            if (!$use_original_name) {
                $name = time(). rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            } else {
                $full_name = $file->getClientOriginalName();
                $extract_name = explode('.', $full_name);

                if ($add_time_to_name){
                    $name = generate_slug($extract_name[0]) . '-' . time(). rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                }else{
                    $name = generate_slug($extract_name[0]) . '.' . $file->getClientOriginalExtension();
                }
            }
            // Store image to public disk
            $file->storeAs($path, $name);
            return $name ?? '';
        } catch (\Exception $ex) {
            return '';
        }
    }

    public function delete($path = '')
    {
        try {
            // Delete image form public directory
            $path = storage_path("app/public/" . $path);
            if (file_exists($path)) unlink($path);
        } catch (\Exception $ex) {
        }
    }
}

