<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class USerImageController extends Controller
{
    /**
     * Update user photo in storage
     *
     * @param $image
     * @param string $oldPhoto
     *
     * @return string $path
     */
    public static function store($image, string $oldPhoto): string
    {
        $path =  $image->store('', 'user');
        if ($oldPhoto !== 'default.png') {
            File::delete(public_path() . '/storage/user/' . $oldPhoto);
        }
        return $path;
    }
}
