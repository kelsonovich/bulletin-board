<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdvertImageController extends Controller
{

    /**
     * Update advert images in storage
     *
     * @param array $arrayImages
     * @param string $url
     *
     * @return string $images
     */
    public static function store(array $arrayImages, string $url): string
    {
        $tmpUrl = public_path() .'/storage/advert/' . $url;
        if (File::exists($tmpUrl)){
            File::cleanDirectory($tmpUrl);
        }

        $images = '';
        foreach ($arrayImages as $key => $value){
            $path    = $value->store($url, 'advert');
            $images .= $path . '*';
        }

        return $images;
    }

    /**
     * Prepare advert images to display
     *
     * @param string $arrayImages
     *
     * @return array $images
     */
    public static function prepareImages(string $arrayImages): array
    {
        $arrayImages  = explode('*', $arrayImages);

        foreach ($arrayImages as $key => $value){
            if ($key === count($arrayImages) - 1){
                break;
            }

            $links[]   = $value;
            $classes[] = ($key === 0) ? 'active' : '';
        }

        return [
            'links' => $links,
            'class' => $classes
        ];
    }
}
