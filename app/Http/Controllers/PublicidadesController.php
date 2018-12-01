<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Publicidades;
use App\Module;

class PublicidadesController extends RestrictedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       #PAGE TITLE E BREADCRUMBS
       $headers = parent::headers(
                   "Publicidades",
                   [["icon" => "", "title" => "Publicidades", "url" => ""]]
               );
       #LISTA DE ITENS
       $items_per_page = config('constants.options.items_per_page');
       $titles = json_encode(["#", "Nome", "Imagem"]);
       $actions = json_encode([
           [
               'path' => '{item}/edit',
               'icon' => 'fa fa-pencil',
               'label' => 'Editar Slide',
               'color' => 'primary'
           ]
       ]);
       if(!empty($request->busca)){
         $busca = $request->busca;
         $items = Publicidades::listItems($items_per_page,$busca);
       }else{
         $busca = "";
         $items = Publicidades::listItems($items_per_page);
       }
       foreach ($items as $item) {
          $arrayImage = array('type' => 'img', 'src' => asset('storage/publicidades/'.$item->image) );
          $item->image = $arrayImage;
       }
       return view('publicidades.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
     }

     private function validation(array $data, $action = 'store'){
       if($action == 'update'){
         return Validator::make($data, [
           'local' => 'required|int',
           'name' => 'required|string|max:200',
           'titulo' => 'required|string|max:50',
           'link' => 'required|string|max:200',
           'image' => 'mimes:jpeg,bmp,png,gif',
         ]);
       }else{
         return Validator::make($data, [
           'local' => 'required|int',
           'name' => 'required|string|max:200',
           'titulo' => 'required|string|max:200',
           'link' => 'required|string|max:200',
           'image' => 'required|mimes:jpeg,bmp,png,gif',
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

       $fileName = '';
       if($request->hasFile('image') && $request->image->isValid()){
           $fileName = $this->upload($request->image);

           if ( !$fileName )
               return redirect()->back()->withErrors($validation)->withInput();
       }

       $page = Publicidades::create([
           'name' => $data['name'],
           'titulo' => $data['titulo'],
           'local' => $data['local'],
           'link' => $data['link'],
           'image' => $fileName
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
                   "Publicidades",
                   [
                       ["icon" => "", "title" => "Publicidades", "url" => route('publicidades.index')],
                       ["icon" => "", "title" => "Editar", "url" => ""]
                   ]
               );

       $item = Publicidades::find($id);

       if(empty($item))
           return redirect()->back();

       return view('publicidades.edit', compact('headers', 'titles', 'item'));
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

       $validation = $this->validation($data, 'update');
       if($validation->fails())
         return redirect()->back()->withErrors($validation)->withInput();

       $fileName = '';
       if($request->hasFile('image') && $request->image->isValid()){
         $fileName = $this->upload($request->image);

         if ( !$fileName )
           return redirect()->back()->withErrors($validation)->withInput();
       }else{
         if(!empty($data['old-image']))
           $fileName = $data['old-image'];
       }


       $page = Publicidades::find($id)->update([
         'name' => $data['name'],
         'titulo' => $data['titulo'],
         'local' => $data['local'],
         'link' => $data['link'],
         'image' => $fileName
       ]);

       return redirect()->route('publicidades.index')->with('message', 'Registro atualizado com sucesso!');
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

       Publicidades::whereIn('id',$data['registro'])->delete();
       return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
     }

     private function upload($file){
       $newName = uniqid(date('HisYmd'));
       $extension = $file->extension();
       $fileName = "{$newName}.{$extension}";

       $upload = $file->storeAs('publicidades', $fileName);

       if ( !$upload )
           return false;

       return $fileName;
   }
}
