<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Cidades;

class CidadesController extends Controller
{
    public function index (Request $request) {
        $cidades = DB::table('cidades')
            ->join('imovels', 'imovels.cidade_id', '=', 'cidades.id')
            ->select('cidades.*')
            ->groupBy('cidades.id')
            ->get();
        return response()->json($cidades, 200);
    }
}
