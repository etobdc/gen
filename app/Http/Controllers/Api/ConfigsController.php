<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Configs;

class ConfigsController extends Controller
{
    public function index (Request $request) {
        $configs = Configs::all();
        return response()->json($configs, 200);
    }
}
