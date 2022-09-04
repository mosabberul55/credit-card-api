<?php

namespace App\Actions\Common;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadManager
{
    private $file;
    private $files;

    public function inputFile($file): UploadManager
    {
        $this->file = $file;
        return $this;
    }

    public function inputFiles($files): UploadManager
    {
        $this->files = $files;
        return $this;
    }

    public function uploadFile($path, $size = null): string
    {
        $image = $this->file;
//        if ($size) {
//            $image = Image::make($this->file)->resize($size['w'], $size['h']);
//        }
        return Storage::putFile($path, $image);
    }

    public function uploadFiles($path, $size = null): array
    {
        $paths = array();
        foreach ($this->files as $file) {
            $image = $this->file;
            if ($size) {
                $image = Image::make($this->file)->resize($size['w'], $size['h']);
            }
            $path = Storage::putFile($path, $image);
            $paths[] = $path;
        }
        return $paths;
    }
}
