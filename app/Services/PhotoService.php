<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\DataTables\EmployeesDataTable;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class PhotoService
{

    public function savePhotoToStorage ($image) {
        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $sm_img = Image::make($image->getRealPath())->resize(50, 50)->stream();

        Storage::disk('local')->put('public/img/faces/'.$fileName, $img, 'public');
        Storage::disk('local')->put('public/img/faces/sm-'.$fileName, $sm_img, 'public');

    }

}

?>
