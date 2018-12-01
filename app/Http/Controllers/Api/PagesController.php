<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Page;

class PagesController extends Controller
{
    public function index (Request $request) {
        if($request->pages){
            $pageIds = explode(',', $request->pages);
            $pages = Page::whereIn('id', $pageIds)->get();
        }else{
            $pages = Page::all();
        }

        foreach ($pages as $key => $value) {
            $value->image = asset("storage/pages/$value->image");
        }

        return response()->json($pages, 200);
    }
}
