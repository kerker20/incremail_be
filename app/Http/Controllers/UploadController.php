<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UploadController extends Controller
{
    public function showImage($id)
    {
        try {
            $template = Image::select("*")->where('template_id', '=', $id)->get();
            if (count($template) > 0) {
                return $template[0];
            } else {
                return response("No template found");
            }
        } catch (\Exception $e) {
            return $e;
            //throw $th;
        }
    }
    public function upload(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'template_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'public/images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Image::create($input);

        return 'Successfully Save!';
    }


    public function displayImage($fileName)
    {
        $path = public_path("public/images\\" . $fileName);
        // return $path;
        return Response::download($path);
    }


    public function showAllImage($id)
    {
        return Image::all()->where('user_id', $id);
    }

}
