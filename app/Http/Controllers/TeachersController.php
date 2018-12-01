<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Teacher;
use App\Module;

class TeachersController extends RestrictedController
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
                    "Professores",
                    [["icon" => "", "title" => "Professores", "url" => ""]]
                );
        
        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Imagem", "Nome"]);
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
          $items = Teacher::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = Teacher::listItems($items_per_page);
        }

        foreach ($items as $key => $value) {
          $items[$key]->image = [
            "type" => 'img',
            "src"=> asset('storage/teachers/'. $value->image)
          ];
        }

        return view('teachers.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data, $action = 'store'){
      if($action == 'update'){
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'description' => 'max:255',
        ]);
      }else{
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'description' => 'max:255',
          'image' => 'required|mimes:jpeg,bmp,png',
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

        if($request->hasFile('image') && $request->image->isValid()){
            $fileName = $this->upload($request->image);
          
            if ( !$fileName )
                return redirect()->back()->withErrors($validation)->withInput();
        }

        $teacher = Teacher::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $fileName
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
                    "Professores",
                    [
                        ["icon" => "", "title" => "Professores", "url" => route('teachers.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = teacher::find($id);

        if(empty($item))
            return redirect()->back();

        return view('teachers.edit', compact('headers', 'titles', 'item'));
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

        if($request->hasFile('image') && $request->image->isValid()){
            $fileName = $this->upload($request->image);
          
            if ( !$fileName )
                return redirect()->back()->withErrors($validation)->withInput();
        }else{
            $fileName = $data['old-image'];
        }

        $teacher = Teacher::find($id)->update([
          'name' => $data['name'],
          'description' => $data['description'],
          'image' => $fileName
        ]);

        return redirect()->route('teachers.index')->with('message', 'Registro atualizado com sucesso!');
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

        Teacher::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function upload($file){
        $newName = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $fileName = "{$newName}.{$extension}";

        $upload = $file->storeAs('teachers', $fileName);
      
        if ( !$upload )
            return false;

        return $fileName;   
    }
}
