<?php

namespace App\Helpers;

class FileHelper
{
    public static function uploadFile($file, $uploadDir)
    {
        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Extract file extension and ensure it is valid
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'png', 'gif', 'pdf', 'docx']; // Adjust based on your needs
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return false; // Invalid file type
        }

        // Generate a unique file name
        $filename = 'image_' . uniqid() . '.' . $fileExtension;

        // Full upload path
        $uploadPath = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $filename; // Return the uploaded file's name
        }

        return false; // Return false on failure
    }


    public static function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

