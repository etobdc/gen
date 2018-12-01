<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Configs;
use App\Module;

class ConfigsController extends RestrictedController
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
      $titles = json_encode(["#", "Nome"]);
      $actions = json_encode([
          [
              'path' => '{item}/edit',
              'icon' => 'fa fa-pencil',
              'label' => 'Editar Configurações',
              'color' => 'primary'
          ]
      ]);

      if(!empty($request->busca)){
        $busca = $request->busca;
        $items = Configs::listItems($items_per_page,$busca);
      }else{
        $busca = "";
        $items = Configs::listItems($items_per_page);
      }

      return view('configs.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data, $action = 'store'){
      if($action == 'update'){
        return Validator::make($data, [
          'keywords'    =>  'required|string|max:250',
          'description' =>  'required|string',
          'facebook'    =>  'max:250',
          'linkedin'    =>  'max:250',
          'instagram'   =>  'max:250',
          'latitude'    =>  'max:25',
          'longitude'   =>  'max:25',
          'endereco'    =>  'required|string|max:350',
          'telefone'    =>  'required|string|max:15',
          'telefone_2'  =>  'max:15',
          'telefone_3'  =>  'max:15',
          'email'       =>  'required|string|max:50',
        ]);
      }else{
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'title' => 'max:255',
        ]);
      }
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

      $page = Configs::create([
          'name' => $data['name'],
          'title' => $data['title'],
          'description' => isset($data['description']) ? $data['description'] : null,
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
                  "Configurações",
                  [
                      ["icon" => "", "title" => "Configurações", "url" => route('configs.index')],
                      ["icon" => "", "title" => "Editar", "url" => ""]
                  ]
              );

      $item = Configs::find($id);

      if(empty($item))
          return redirect()->back();

      return view('configs.edit', compact('headers', 'titles', 'item'));
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

      $page = Configs::find($id)->update([
        'keywords' => $data['keywords'],
        'facebook' => $data['facebook'],
        'linkedin' => $data['linkedin'],
        // 'instagram' => $data['instagram'],
        'endereco' => $data['endereco'],
        'latitude' => $data['latitude'],
        'longitude' => $data['longitude'],
        'telefone' => $data['telefone'],
        'telefone_2' => $data['telefone_2'],
        'telefone_3' => $data['telefone_3'],
        'email' => $data['email'],
        'description' => isset($data['description']) ? $data['description'] : null
      ]);

      return redirect()->route('configs.index')->with('message', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = $req->all();

      Configs::whereIn('id',$data['registro'])->delete();
      return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }
}
