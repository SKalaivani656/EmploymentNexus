<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Storage;

trait UploadTrait
{
    public function uploadOne($originalImage, $originalPath, $thumbnailPath, $model, $ration, $resize)
    {
        if (request()->id) {
            $image = $model::where('id', request()->id)->first()->image;
            if ($image) {
                Storage::disk('public')->delete($originalPath . $image);
                Storage::disk('public')->delete($thumbnailPath . $image);
            }
        }

        $imgname = time() . uniqid() . '.jpg';

        $saveimage = Image::make($originalImage);
        $saveimage->encode('jpg', 100);
        $saveimage->stream();
        Storage::disk('public')->put($originalPath . '/' . $imgname, $saveimage, 'public');

        $saveimage = Image::make($originalImage);
        $saveimage->resize($resize[0], $resize[1]);
        $saveimage->encode('jpg', $ration);
        $saveimage->stream();

        Storage::disk('public')->put($thumbnailPath . '/' . $imgname, $saveimage, 'public');

        return $imgname;
    }
}
