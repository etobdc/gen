<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Depoimentos;

class DepoimentosController extends Controller
{
    public function index (Request $request) {
        $depoimentos = Depoimentos::all();

        foreach ($depoimentos as $key => $value) {
            $value->image = asset("storage/depoimentos/$value->image");
        }

        return response()->json($depoimentos, 200);
    }
}
