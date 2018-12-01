<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Level;
use App\Module;

class LevelsController extends RestrictedController
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
                    "Categorias",
                    [["icon" => "", "title" => "Grupo de Usuários", "url" => ""]]
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
          $items = Level::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = Level::listItems($items_per_page);
        }

        return view('levels.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data){
      return Validator::make($data, [
        'name' => 'required|string|max:255'
      ]);
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

        if($this->validation($data)->fails())
          return redirect()->back()->withErrors($validation)->withInput();

        $slug = str_slug($data['name'], '-');

        $countSlug = Level::where('slug', $slug)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $level = Level::create([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
        ]);

        return redirect()->back()->with('message', 'Registro gravado com sucesso!');
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
                    "Categorias",
                    [
                        ["icon" => "", "title" => "Categorias", "url" => route('levels.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = level::find($id);

        if(empty($item))
            return redirect()->back();

        return view('levels.edit', compact('headers', 'titles', 'item'));
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

        $validation = $this->validation($data);
        if($validation->fails())
          return redirect()->back()->withErrors($validation)->withInput();

        $slug = str_slug($data['name'], '-');

        $countSlug = Level::where('slug', $slug)->where('id', '!=', $id)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $level = Level::find($id)->update([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
        ]);

        return redirect()->route('levels.index')->with('message', 'Registro atualizado com sucesso!');
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

        Level::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }
}
