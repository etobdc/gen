<?php

namespace App\Http\Controllers\Imovel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Caracteristicas;
use App\Module;

class CaracteristicasController extends RestrictedController
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
                   "Caracteristicas",
                   [
                     ["icon" => "", "title" => "Imóveis", "url" => route('imovel.index')],
                     ["icon" => "", "title" => "Caracteristicas", "url" => ""]
                   ]
               );

       #LISTA DE ITENS
       $items_per_page = config('constants.options.items_per_page');
       $titles = json_encode(["#", "Nome"]);
       $actions = json_encode([
             [
                 'path' => '{item}/edit',
                 'icon' => 'fa fa-pencil',
                 'label' => 'Editar Item',
                 'color' => 'primary'
             ]
         ]);

       if(!empty($request->busca)){
         $busca = $request->busca;
         $items = Caracteristicas::listItems($items_per_page, $imovelId, $busca);
       }else{
         $busca = "";
         $items = Caracteristicas::listItems($items_per_page, $imovelId);
       }

       return view('imovel.caracteristicas.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'imovelId'));
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

         Caracteristicas::create([
             'imovel_id'  => $imovelId,
             'name' => $data['name'],
             'quantidade' => $data['quantidade']
         ]);

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
                     "Caracteristicas",
                     [
                         ["icon" => "", "title" => "Imóveis", "url" => route('imovel.index')],
                         ["icon" => "", "title" => "Caracteristicas", "url" => route('imovel.caracteristicas.index', $imovelId)],
                         ["icon" => "", "title" => "Editar", "url" => ""]
                     ]
                 );

         $item = Caracteristicas::find($id);

         if(empty($item))
             return redirect()->back();

         return view('imovel.caracteristicas.edit', compact('headers', 'titles', 'item', 'trails', 'imovelId'));
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

         Caracteristicas::find($id)->update([
             'imovel_id'  => $imovelId,
             'name' => $data['name'],
             'quantidade' => $data['quantidade']
         ]);

         return redirect()->route('imovel.caracteristicas.index', $imovelId)->with('message', 'Registro atualizado com sucesso!');
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
         Caracteristicas::whereIn('id',$data['registro'])->delete();
         return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
     }

     private function validation(array $data, $action){
         return Validator::make($data, [
                 'name' => 'required',
         ]);
     }
}
