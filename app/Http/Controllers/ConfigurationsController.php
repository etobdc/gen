<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Configuration;

class ConfigurationsController extends RestrictedController
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
                    "Configurações",
                    [["icon" => "", "title" => "Configurações", "url" => ""]]
                );
        
        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Configuração"]);
        $actions = json_encode([
            [  
                'path' => '{item}/edit',
                'icon' => 'fa fa-pencil',
                'label' => 'Editar Item',
                'color' => 'primary'
            ]
        ]);
        
        if(!empty($request->search)){
          $search = $request->search;
          $items = Configuration::listItems($items_per_page,$search);
        }else{
          $search = "";
          $items = Configuration::listItems($items_per_page);
        }

        return view('configurations.index', compact('headers', 'titles', 'items', 'search', 'actions'));
    }

    private function validation(array $data){
      return Validator::make($data, [
        'name' => 'required|string|max:255'
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
                    "Configurações",
                    [
                        ["icon" => "", "title" => "Configurações", "url" => route('configurations.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = Configuration::find($id);

        if(empty($item))
            return redirect()->back();

        return view('configurations.edit', compact('headers', 'titles', 'item'));
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
       
        Configuration::find($id)->update([
            'value' => $data['value']
        ]);
        
        return redirect()->route('configurations.index')->with('message', 'Registro atualizado com sucesso!');
    }
}
