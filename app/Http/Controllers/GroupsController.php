<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Group;
use App\Module;

class GroupsController extends RestrictedController
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
                    "Grupos de Usuários",
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
          $items = Group::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = Group::listItems($items_per_page);
        }

        $modules = Module::getModules();

        return view('groups.index', compact('headers', 'titles', 'items', 'modules', 'busca', 'actions'));
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

        $group = Group::create([
            'name' => $data['name']
        ]);

        if(!empty($data['module_id'])){
            $group->modules()->attach($data['module_id']);
        }

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
                    "Grupos de Usuários",
                    [
                        ["icon" => "", "title" => "Grupos de Usuários", "url" => route('groups.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = group::find($id);

        if(empty($item))
            return redirect()->back();

        $modules = Module::getModules();

        $group_modules = $item->modules()->get();
        
        $group_modules_ids = [];
        foreach ($group_modules as $key => $value) {
            array_push($group_modules_ids, $value->id);
        }

        return view('groups.edit', compact('headers', 'titles', 'item', 'modules', 'group_modules_ids'));
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

        if($this->validation($data)->fails())
          return redirect()->back()->withErrors($validation)->withInput();

        $item = Group::find($id);
        
        $item->update([
            'name' => $data['name']
        ]);
        
        if(!empty($data['module_id'])){
            $item->modules()->sync($data['module_id']);
        }else{
            $item->modules()->sync([]);
        }
        
        return redirect()->route('groups.index')->with('message', 'Registro atualizado com sucesso!');
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

        Group::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }
}
