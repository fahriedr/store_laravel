<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

trait GlobalHelper
{

    public function uploadImageProduct($id, $sourceFile, $name = null, $width = 700, $height = 700)
    {
        $fileName = $name == null ? time() . '' . random_int(1000, 9999) . '.' . $sourceFile->getClientOriginalExtension() : $name;
        Storage::disk('public')->put('product_images/' . $id . '/' . $fileName, $sourceFile);

        return Storage::url('product_images/' . $id . '/' . $fileName);
    }
}
