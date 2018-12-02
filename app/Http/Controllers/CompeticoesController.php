<?php

namespace App\Http\Controllers;

use App\Competicoes;
use App\Http\Controllers\RestrictedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompeticoesController extends RestrictedController
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
            "Competições",
            [["icon" => "", "title" => "Competições", "url" => ""]]
        );
        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Nome"]);
        $actions = json_encode([
            [
                'path' => '{item}/edit',
                'icon' => 'fa fa-pencil',
                'label' => 'Editar Competição',
                'color' => 'primary',
            ],
            [
                'path' => '{item}/provas',
                'icon' => 'fa fa-tasks',
                'label' => 'Provas',
                'color' => 'success',
            ],
        ]);
        if (!empty($request->busca)) {
            $busca = $request->busca;
            $items = Competicoes::listItems($items_per_page, $busca);
        } else {
            $busca = "";
            $items = Competicoes::listItems($items_per_page);
        }

        return view('competicoes.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data, $action = 'store')
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
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
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $page = Competicoes::create([
            'name' => $data['name'],
            'date' => $data['date'],
            'local' => $data['local'],
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
            "Competições",
            [
                ["icon" => "", "title" => "Competições", "url" => route('competicoes.index')],
                ["icon" => "", "title" => "Editar", "url" => ""],
            ]
        );

        $item = Competicoes::find($id);

        if (empty($item)) {
            return redirect()->back();
        }

        return view('competicoes.edit', compact('headers', 'titles', 'item'));
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
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $page = Competicoes::find($id)->update([
            'name' => $data['name'],
            'date' => $data['date'],
            'local' => $data['local'],
        ]);

        return redirect()->route('competicoes.index')->with('message', 'Registro atualizado com sucesso!');
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

        Competicoes::whereIn('id', $data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }
}
