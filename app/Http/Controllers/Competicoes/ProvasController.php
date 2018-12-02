<?php

namespace App\Http\Controllers\Competicoes;

use App\Http\Controllers\RestrictedController;
use App\Prova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvasController extends RestrictedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $competicaoId)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
            "Provas",
            [
                ["icon" => "", "title" => "Competições", "url" => route('competicoes.index')],
                ["icon" => "", "title" => "Provas", "url" => ""],
            ]
        );

        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Nome"]);
        $actions = json_encode([
            [
                'path' => '{item}/edit',
                'icon' => 'fa fa-pencil',
                'label' => 'Editar Prova',
                'color' => 'primary',
            ],
        ]);

        if (!empty($request->busca)) {
            $busca = $request->busca;
            $items = Prova::listItems($items_per_page, $competicaoId, $busca);
        } else {
            $busca = "";
            $items = Prova::listItems($items_per_page, $competicaoId);
        }

        return view('competicoes.provas.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'competicaoId'));
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
    public function store(Request $request, $competicaoId)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'store');
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Prova::create([
            'competicao_id' => $competicaoId,
            'name' => $data['name'],
            'prova' => $data['prova'],
            'masculino' => isset($data['masculino']) ? '1' : '0',
            'feminino' => isset($data['feminino']) ? '1' : '0',
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
    public function edit($competicaoId, $id)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
            "Provas",
            [
                ["icon" => "", "title" => "Competições", "url" => route('competicoes.index')],
                ["icon" => "", "title" => "Provas", "url" => route('competicoes.provas.index', $competicaoId)],
                ["icon" => "", "title" => "Editar", "url" => ""],
            ]
        );

        $item = Prova::find($id);

        if (empty($item)) {
            return redirect()->back();
        }

        return view('competicoes.provas.edit', compact('headers', 'titles', 'item', 'trails', 'competicaoId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $competicaoId, $id)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'update');

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Prova::find($id)->update([
            'competicao_id' => $competicaoId,
            'name' => $data['name'],
            'prova' => $data['prova'],
            'masculino' => isset($data['masculino']) ? '1' : '0',
            'feminino' => isset($data['feminino']) ? '1' : '0',
        ]);

        return redirect()->route('competicoes.provas.index', $competicaoId)->with('message', 'Registro atualizado com sucesso!');
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
        Prova::whereIn('id', $data['registro'])->delete();
        return redirect()->back()->with('message', 'Nadadores excluídos com sucesso!');
    }

    private function validation(array $data, $action)
    {
        return Validator::make($data, [
            'name' => 'required',
        ]);
    }
}
