<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait GlobalHelper
{

    public function uploadImageProduct($id, $sourceFile, $width = 600, $height = 600)
    {

        $fileName = time() . '' . random_int(1000, 9999) . '.' . $sourceFile->getClientOriginalExtension();
        $image = $this->resizeImage($sourceFile, $width, $height);
        Storage::disk('public')->put('product_images/' . $id . '/' . $fileName, (string)$image);

        return Storage::url('product_images/' . $id . '/' . $fileName);
    }

    public function resizeImage($file, $width, $height)
    {
        $resize = Image::make($file)->resize($width, $height)->encode('png');

        return $resize;
    }
}
