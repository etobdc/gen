<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Cidades;
use App\Module;

class CidadesController extends RestrictedController
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
                   "Cidades",
                   [["icon" => "", "title" => "Cidades", "url" => ""]]
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
           ],
           [
               'path' => '{item}/bairros',
               'icon' => 'fa fa-map-marker',
               'label' => 'Bairros',
               'color' => 'success'
           ]
       ]);
       if(!empty($request->busca)){
         $busca = $request->busca;
         $items = Cidades::listItems($items_per_page,$busca);
       }else{
         $busca = "";
         $items = Cidades::listItems($items_per_page);
       }

       return view('cidades.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
     }

     private function validation(array $data, $action = 'store'){
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'uf' => 'required|string|max:2'
        ]);
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


       $page = Cidades::create([
           'name' => $data['name'],
           'uf' => $data['uf']
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
                   "Cidades",
                   [
                       ["icon" => "", "title" => "Cidades", "url" => route('cidades.index')],
                       ["icon" => "", "title" => "Editar", "url" => ""]
                   ]
               );

       $item = Cidades::find($id);

       if(empty($item))
           return redirect()->back();

       return view('cidades.edit', compact('headers', 'titles', 'item'));
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

       $page = Cidades::find($id)->update([
         'name' => $data['name'],
         'uf' => $data['uf']
       ]);

       return redirect()->route('cidades.index')->with('message', 'Registro atualizado com sucesso!');
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

       Cidades::whereIn('id',$data['registro'])->delete();
       return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
     }
}
