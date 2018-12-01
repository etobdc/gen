<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Depoimentos;
use App\Module;

class DepoimentosController extends RestrictedController
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
                  "Depoimentos",
                  [["icon" => "", "title" => "Depoimentos", "url" => ""]]
              );
      #LISTA DE ITENS
      $items_per_page = config('constants.options.items_per_page');
      $titles = json_encode(["#", "Nome"]);
      $actions = json_encode([
          [
              'path' => '{item}/edit',
              'icon' => 'fa fa-pencil',
              'label' => 'Editar Depoimento',
              'color' => 'primary'
          ]
      ]);
      if(!empty($request->busca)){
        $busca = $request->busca;
        $items = Depoimentos::listItems($items_per_page,$busca);
      }else{
        $busca = "";
        $items = Depoimentos::listItems($items_per_page);
      }

      return view('depoimentos.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data, $action = 'store'){
      if($action == 'update'){
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'description' => 'required|string',
          'image' => 'mimes:jpeg,bmp,png,gif',
        ]);
      }else{
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'description' => 'required|string',
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

      $page = Depoimentos::create([
          'name' => $data['name'],
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
                  "Depoimentos",
                  [
                      ["icon" => "", "title" => "Depoimentos", "url" => route('depoimentos.index')],
                      ["icon" => "", "title" => "Editar", "url" => ""]
                  ]
              );

      $item = Depoimentos::find($id);

      if(empty($item))
          return redirect()->back();

      return view('depoimentos.edit', compact('headers', 'titles', 'item'));
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

      $page = Depoimentos::find($id)->update([
        'name' => $data['name'],
        'description' => isset($data['description']) ? $data['description'] : null,
        'image' => $fileName
      ]);

      return redirect()->route('depoimentos.index')->with('message', 'Registro atualizado com sucesso!');
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

      Depoimentos::whereIn('id',$data['registro'])->delete();
      return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function upload($file){
      $newName = uniqid(date('HisYmd'));
      $extension = $file->extension();
      $fileName = "{$newName}.{$extension}";

      $upload = $file->storeAs('depoimentos', $fileName);

      if ( !$upload )
          return false;

      return $fileName;
  }
}
