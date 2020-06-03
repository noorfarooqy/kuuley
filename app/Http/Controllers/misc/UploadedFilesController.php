<?php

namespace App\Http\Controllers\misc;

use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadedFilesController extends Controller
{
    //

    public function UploadNewFile(Request $request)
    {
        $user = $request->user();
        $rules = [
            "upload_file" => "requred|file",
        ];

        $data = $request->validate($rules);
        $path = hash('md5', $user->id);
        $path = "uploads/$path";

        $uploaded = $this->AddNewFile($data["uploaded_file"], $path);// Storage::disk('public')->putFile($path, );
        if($uploaded)
        {
            return Response()->json(["success" => true, 'data'=>["file_src" => Storage::disk('public')->url($uploaded)]]);
        }
        return Response()->json(["success" => false, 'data' => null]);
    }

    public function AddNewFile($file, $path)
    {
        return  Storage::disk('public')->putFile($path, $file);
    }
    
}
