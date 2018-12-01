<?php

namespace App\Http\Controllers\Cidades;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Bairros;
use App\Module;

class BairrosController extends RestrictedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request, $cidadeId)
     {
       #PAGE TITLE E BREADCRUMBS
       $headers = parent::headers(
                   "Bairros",
                   [
                     ["icon" => "", "title" => "Cidades", "url" => route('cidades.index')],
                     ["icon" => "", "title" => "Bairros", "url" => ""]
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
         $items = Bairros::listItems($items_per_page, $cidadeId, $busca);
       }else{
         $busca = "";
         $items = Bairros::listItems($items_per_page, $cidadeId);
       }

       return view('cidades.bairros.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'cidadeId'));
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
     public function store(Request $request, $cidadeId)
     {
         $data = $request->all();

         $validation = $this->validation($data, 'store');
         if($validation->fails()){
             return redirect()->back()->withErrors($validation)->withInput();
         }

         Bairros::create([
             'cidade_id'  => $cidadeId,
             'name' => $data['name']
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
     public function edit($cidadeId, $id)
     {
         #PAGE TITLE E BREADCRUMBS
         $headers = parent::headers(
                     "Bairros",
                     [
                         ["icon" => "", "title" => "Cidades", "url" => route('cidades.index')],
                         ["icon" => "", "title" => "Bairros", "url" => route('cidades.bairros.index', $cidadeId)],
                         ["icon" => "", "title" => "Editar", "url" => ""]
                     ]
                 );

         $item = Bairros::find($id);

         if(empty($item))
             return redirect()->back();

         return view('cidades.bairros.edit', compact('headers', 'titles', 'item', 'trails', 'cidadeId'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $cidadeId, $id)
     {
         $data = $request->all();

         $validation = $this->validation($data, 'update');

         if($validation->fails()){
             return redirect()->back()->withErrors($validation)->withInput();
         }

         Bairros::find($id)->update([
             'cidade_id'  => $cidadeId,
             'name' => $data['name']
         ]);

         return redirect()->route('cidades.bairros.index', $cidadeId)->with('message', 'Registro atualizado com sucesso!');
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
         Bairros::whereIn('id',$data['registro'])->delete();
         return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
     }

     private function validation(array $data, $action){
         return Validator::make($data, [
                 'name' => 'required',
         ]);
     }
}
