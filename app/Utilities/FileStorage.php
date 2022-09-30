<?php

namespace App\Utilities;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Mime\MimeTypes;

class FileStorage
{

    /**
     * Store file into app storage
     * Makesure storage is linked (php artisan storage:link)
     * @param String $file Octet Stream of Base64 encoded file. Make sure you include the base64:mime/type of the file
     * @param  String in which folder the file will be stored. The default value was default. The path MUST NOT START OR END WITH /. example value : image/icons
     * @param String If you didn't trust the autodetect system you can give this params a value like pdf
     * @return String path
     */
    static function store($file, $path = "default", $format = "none")
    {
        try {
            $fileData = explode(",", $file);
            $decoded = base64_decode($fileData[1]);
            $ext = [$format];
            if ($ext[0] == "none") {
                $f = finfo_open();
                $mime = finfo_buffer($f, $decoded, FILEINFO_MIME_TYPE);
                $tool = new MimeTypes();
                $ext = $tool->getExtensions($mime);
            }

            if(sizeof($ext) < 1){
                throw new Exception("Unknown / Missing File Type, makesure include the mime in your base64 encoded file");
            }
            $fileName = Uuid::uuid4()->toString() . "." . $ext[0];

            $filePath = $path . "/" . $fileName;
            Storage::disk('public')->put($filePath, $decoded);

            return $filePath;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete file from storage
     * @param String $filepath The exact path of file which want to be deleted. e.g /storage/image/profile.png
     * @return Boolean true if success, false if error or file not found
     */
    static function delete($filePath)
    {
        try {
            $appPath = storage_path("app/public/" . $filePath);

            if (File::exists($appPath)) {
                unlink($appPath);
            } else {
                throw new Exception('File not exists');
            }
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
