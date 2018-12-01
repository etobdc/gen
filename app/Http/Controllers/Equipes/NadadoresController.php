<?php

namespace App\Http\Controllers\Equipes;

use App\Http\Controllers\RestrictedController;
use App\Nadador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NadadoresController extends RestrictedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $equipeId)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
            "Nadadores",
            [
                ["icon" => "", "title" => "Equipes", "url" => route('equipes.index')],
                ["icon" => "", "title" => "Nadadores", "url" => ""],
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
                'color' => 'primary',
            ],
        ]);

        if (!empty($request->busca)) {
            $busca = $request->busca;
            $items = Nadador::listItems($items_per_page, $equipeId, $busca);
        } else {
            $busca = "";
            $items = Nadador::listItems($items_per_page, $equipeId);
        }

        return view('equipes.nadadores.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'equipeId'));
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
    public function store(Request $request, $equipeId)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'store');
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Nadador::create([
            'equipe_id' => $equipeId,
            'name' => $data['name'],
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
    public function edit($equipeId, $id)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
            "Nadadores",
            [
                ["icon" => "", "title" => "Equipes", "url" => route('equipes.index')],
                ["icon" => "", "title" => "Nadadores", "url" => route('equipes.nadadores.index', $equipeId)],
                ["icon" => "", "title" => "Editar", "url" => ""],
            ]
        );

        $item = Nadador::find($id);

        if (empty($item)) {
            return redirect()->back();
        }

        return view('equipes.nadadores.edit', compact('headers', 'titles', 'item', 'trails', 'equipeId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $equipeId, $id)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'update');

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Nadador::find($id)->update([
            'equipe_id' => $equipeId,
            'name' => $data['name'],
        ]);

        return redirect()->route('equipes.nadadores.index', $equipeId)->with('message', 'Registro atualizado com sucesso!');
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
        Nadador::whereIn('id', $data['registro'])->delete();
        return redirect()->back()->with('message', 'Nadadores excluídos com sucesso!');
    }

    private function validation(array $data, $action)
    {
        return Validator::make($data, [
            'name' => 'required',
        ]);
    }
}
