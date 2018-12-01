<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Blogs;

class BlogsController extends Controller
{
    public function index (Request $request) {
        $perPage = 15;
        if($request->per_page){
            $perPage = $request->per_page;
        }
        
        $blogs = Blogs::orderBy('id', 'DESC');

        if($request->limit){
            $blogs = $blogs->limit($request->limit)->get();
        }else{
            $blogs = $blogs->paginate($perPage);
        }
        

        foreach ($blogs as $key => $value) {
            $value->thumbnail = asset("storage/blogs/$value->thumbnail");
            $value->image = asset("storage/blogs/$value->image");
        }

        return response()->json($blogs, 200);
    }

    public function show ($slug) {
        $blog = Blogs::where('slug', $slug)->first();

        if(!$blog){
            return response()->json('', 404);    
        }
        
        $blog->image = asset('storage/blogs/'.$blog->image);
        $blog->thumbnail = asset('storage/blogs/'.$blog->thumbnail);

        return response()->json($blog, 200);
    }
}
