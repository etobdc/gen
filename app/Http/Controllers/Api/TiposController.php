<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Tipos;

class TiposController extends Controller
{
    public function index (Request $request) {
        $tipos = DB::table('tipos')
            ->join('imovels', 'imovels.tipo_id', '=', 'tipos.id')
            ->select('tipos.*')
            ->groupBy('tipos.id')
            ->get();
        return response()->json($tipos, 200);
    }
}
