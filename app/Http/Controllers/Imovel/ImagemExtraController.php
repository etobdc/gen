<?php

namespace App\Http\Controllers\Imovel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\ImagemExtra;
use App\Module;

class ImagemExtraController extends RestrictedController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index(Request $request, $imovelId)
   {
     #PAGE TITLE E BREADCRUMBS
     $headers = parent::headers(
                 "Imagens",
                 [
                   ["icon" => "", "title" => "Imóveis", "url" => route('imovel.index')],
                   ["icon" => "", "title" => "Imagens", "url" => ""]
                 ]
             );

     #LISTA DE ITENS
     $items_per_page = config('constants.options.items_per_page');
     $titles = json_encode(["#", "Imagem"]);
     $actions = json_encode([
       ]);

     if(!empty($request->busca)){
       $busca = $request->busca;
       $items = ImagemExtra::listItems($items_per_page, $imovelId, $busca);
     }else{
       $busca = "";
       $items = ImagemExtra::listItems($items_per_page, $imovelId);
     }
     foreach ($items as $item) {
        $arrayImage = array('type' => 'img', 'src' => asset('storage/imovel/'.$item->image) );
        $item->image = $arrayImage;
     }
     return view('imovel.imagens.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'imovelId'));
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
   public function store(Request $request, $imovelId)
   {
       $data = $request->all();
       $validation = $this->validation($data, 'store');
       if($validation->fails()){
           return redirect()->back()->withErrors($validation)->withInput();
       }
       foreach ($request->image as $image) {
         $fileName = '';
         if($request->hasFile('image') && $image->isValid()){
           $fileName = $this->upload($image);

           if ( !$fileName )
           return redirect()->back()->withErrors($validation)->withInput();
         }

         ImagemExtra::create([
           'imovel_id'  => $imovelId,
           'image' => $fileName
         ]);
       }

       return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
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
   public function edit($imovelId, $id)
   {
       #PAGE TITLE E BREADCRUMBS
       $headers = parent::headers(
                   "ImagemExtra",
                   [
                       ["icon" => "", "title" => "Imóveis", "url" => route('imovel.index')],
                       ["icon" => "", "title" => "ImagemExtra", "url" => route('imovel.imagens.index', $imovelId)],
                       ["icon" => "", "title" => "Editar", "url" => ""]
                   ]
               );

       $item = ImagemExtra::find($id);

       if(empty($item))
           return redirect()->back();

       return view('imovel.imagens.edit', compact('headers', 'titles', 'item', 'trails', 'imovelId'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $imovelId, $id)
   {
       $data = $request->all();

       $validation = $this->validation($data, 'update');

       if($validation->fails()){
           return redirect()->back()->withErrors($validation)->withInput();
       }

       ImagemExtra::find($id)->update([
           'imovel_id'  => $imovelId,
           'imagem' => $data['image']
       ]);

       return redirect()->route('imovel.imagens.index', $imovelId)->with('message', 'Registro atualizado com sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Request $req)
   {
       $data = $req->all();
       ImagemExtra::whereIn('id',$data['registro'])->delete();
       return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
   }

   private function validation(array $data, $action){
       return Validator::make($data, [
               'image' => 'required',
       ]);
   }
   private function upload($file){
     $newName = uniqid(date('HisYmd'));
     $extension = $file->extension();
     $fileName = "{$newName}.{$extension}";

     $upload = $file->storeAs('imovel', $fileName);

     if ( !$upload )
         return false;

     return $fileName;
 }
}
