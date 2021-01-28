<?php

namespace App\Helper;

use App\Models\Products;
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

    public function getCodeProduct($length = 15)
    {
        $status = true;

        while ($status) {
            $code_product = $this->generateCodeUnique($length);
            $check = Products::where('code_product', $code_product)->first();
            $status = $check != null ? true : false;
        }

        return $code_product;
    }

    public function generateCodeUnique($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $char_length = strlen($characters);

        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $char_length - 1)];
        }

        return $random_string;
    }
}
