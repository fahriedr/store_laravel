<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

trait GlobalHelper {


    public function uploadImageProduct($sourceFile, $name = null, $width = 700, $height =700)
    {
        $fileName = $name == null ? time() . '' . random_int(1000 , 9999) . '.' . $sourceFile->getClientOriginalExtension() : $name;
        // $destinationPath = Storage::disk('public')->get();
        $result = Storage::disk('local')->put($fileName, file_get_contents($sourceFile));

        return $fileName;
    }

}


?>