<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Slides;

class SlidesController extends Controller
{
    public function index (Request $request) {
        $slides = Slides::all();

        foreach ($slides as $key => $value) {
            $value->image = asset("storage/slides/$value->image");
        }

        return response()->json($slides, 200);
    }
}
