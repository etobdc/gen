<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Blogs;
use App\Module;

use App\Traits;

class BlogsController extends RestrictedController
{

  use Traits\SlugTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       #PAGE TITLE E BREADCRUMBS
       $headers = parent::headers(
                   "Blogs",
                   [["icon" => "", "title" => "Blogs", "url" => ""]]
               );
       #LISTA DE ITENS
       $items_per_page = config('constants.options.items_per_page');
       $titles = json_encode(["#", "Nome"]);
       $actions = json_encode([
           [
               'path' => '{item}/edit',
               'icon' => 'fa fa-pencil',
               'label' => 'Editar Blog',
               'color' => 'primary'
           ]
       ]);
       if(!empty($request->busca)){
         $busca = $request->busca;
         $items = Blogs::listItems($items_per_page,$busca);
       }else{
         $busca = "";
         $items = Blogs::listItems($items_per_page);
       }

       return view('blogs.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
     }

     private function validation(array $data, $action = 'store'){
       if($action == 'update'){
         return Validator::make($data, [
           'name' => 'required|string|max:255',
           'lead' => 'required|string',
           'description' => 'required|string',
           'image' => 'nullable|mimes:jpeg,bmp,png,gif',
           'thumbnail' => 'nullable|mimes:jpeg,bmp,png,gif',
         ]);
       }else{
         return Validator::make($data, [
           'name' => 'required|string|max:255',
           'lead' => 'required|string',
           'description' => 'required|string',
           'image' => 'required|mimes:jpeg,bmp,png,gif',
           'thumbnail' => 'required|mimes:jpeg,bmp,png,gif',
         ]);
       }
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       $data = $request->all();

       $validation = $this->validation($data, 'store');
       if($validation->fails())
         return redirect()->back()->withErrors($validation)->withInput();

       $thumbnail = '';
       if($request->hasFile('thumbnail') && $request->thumbnail->isValid()){
           $thumbnail = $this->upload($request->thumbnail);

           if ( !$thumbnail )
               return redirect()->back()->withErrors($validation)->withInput();
       }

       $image = '';
       if($request->hasFile('image') && $request->image->isValid()){
           $image = $this->upload($request->image);

           if ( !$image )
               return redirect()->back()->withErrors($validation)->withInput();
       }

       $slug = $this->getSlug($data['name'], 'blogs');

       $countSlug = Blogs::where('slug', $slug)->count();
       if($countSlug > 0)
           $slug .= "-$countSlug";

       $page = Blogs::create([
           'name' => $data['name'],
           'slug' => $slug,
           'lead' => $data['lead'],
           'description' => isset($data['description']) ? $data['description'] : null,
           'thumbnail' => $thumbnail,
           'image' => $image
       ]);

       return redirect()->back()->with('message', 'Registro gravado com sucesso!');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
       #PAGE TITLE E BREADCRUMBS
       $headers = parent::headers(
                   "Blogs",
                   [
                       ["icon" => "", "title" => "Blogs", "url" => route('blogs.index')],
                       ["icon" => "", "title" => "Editar", "url" => ""]
                   ]
               );

       $item = Blogs::find($id);

       if(empty($item))
           return redirect()->back();

       return view('blogs.edit', compact('headers', 'titles', 'item'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
       $data = $request->all();

      $blog = Blogs::find($id);

       $validation = $this->validation($data, 'update');
       if($validation->fails())
         return redirect()->back()->withErrors($validation)->withInput();

       $thumbnail = $blog->thumbnail;
       if($request->hasFile('thumbnail') && $request->thumbnail->isValid()){
         $thumbnail = $this->upload($request->thumbnail);

         if ( !$thumbnail )
           return redirect()->back()->withErrors($validation)->withInput();
       }

       $image = $blog->image;
       if($request->hasFile('image') && $request->image->isValid()){
         $image = $this->upload($request->image);

         if ( !$image )
           return redirect()->back()->withErrors($validation)->withInput();
       }

       $slug = $blog->slug;
       if($slug !== str_slug($data['name'], '-')){
        $slug = $this->getSlug($data['name'], 'blogs');
       }

       $page = Blogs::find($id)->update([
         'name' => $data['name'],
         'slug' => $slug,
         'lead' => $data['lead'],
         'description' => isset($data['description']) ? $data['description'] : null,
         'thumbnail' => $thumbnail,
         'imge' => $image
       ]);

       return redirect()->route('blogs.index')->with('message', 'Registro atualizado com sucesso!');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Request $request, $id)
     {
       $data = $request->all();

       Blogs::whereIn('id',$data['registro'])->delete();
       return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
     }

     private function upload($file){
       $newName = uniqid(date('HisYmd'));
       $extension = $file->extension();
       $fileName = "{$newName}.{$extension}";

       $upload = $file->storeAs('blogs', $fileName);

       if ( !$upload )
           return false;

       return $fileName;
   }
}
