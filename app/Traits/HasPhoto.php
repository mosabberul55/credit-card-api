<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasPhoto
{
    public static function bootHasPhoto()
    {

    }

    public static function initializeHasPhoto()
    {

    }

    public function getPhotoAttribute($photo): ?string
    {
        return $photo ? Storage::url($photo) : null;
    }
}
