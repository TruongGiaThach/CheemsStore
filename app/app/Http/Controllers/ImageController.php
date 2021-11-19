<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class ImageController extends Controller
{


    public function deleteImage($product_image)
    {
        //
        $deleted = TRUE;
        $image_path = 'public/images/' + $product_image;
        if(file_exists($image_path))
        {
            @unlink($image_path);
            //$deleted = Storage::disk('public')-> delete($product_image);
        }
        return response()->json([
            'status' => $deleted,
            'message' => $deleted ? 'Image Deleted!' : 'Error Deleting Image'
        ]);
    }
}