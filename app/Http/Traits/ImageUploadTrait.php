<?php

namespace App\Http\Traits;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

trait ImageUploadTrait {
    /**
     *  Taking input image as parameter
     *  Return url image.
     */
    public function imageUpload($image, $model, $object = null )
    {
        $fileName = '';
        // delete old image if exist.
        if ($object != null && $object->image != null) 
            Storage::delete($object->image);
        //add new image
        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->stream();
        Storage::disk('local')->put('public/'.$model.'/'.$fileName, $img, 'public');
        $fileName = 'storage/'.$model.'/'.$fileName;
        return $fileName; 
    }
}