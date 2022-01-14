<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ImageUploadTrait;
use Validator;

class MediaController extends Controller
{
    use ImageUploadTrait;

    //
    public function upload_file(Request $request, $folder){
         $validateErrors = Validator::make($request->all(),
                [


                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

                ]);
            if ($validateErrors->fails()) {
                return response()->json(['status' => 201, 'message' => $validateErrors->errors()->first()]);
            } // end if fails .

        if($request->hasFile('file')){

            $image = $this->imageUpload($request['file'],$folder);
            return response()->json(["file_name"=>$image]);
        }

            return response()->json(["status"=>500]);



    }
}
