<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Category;
use App\Module;

class CategoriesController extends RestrictedController
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
                    [["icon" => "", "title" => "Categorias", "url" => ""]]
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
          $items = Category::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = Category::listItems($items_per_page);
        }

        return view('categories.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data, $action = 'store'){
      if($action == 'update'){
        return Validator::make($data, [
          'name' => 'required|string|max:255',
        ]);
      }else{
        return Validator::make($data, [
          'name' => 'required|string|max:255',
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

        $slug = str_slug($data['name'], '-');

        $countSlug = Category::where('slug', $slug)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $category = Category::create([
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $fileName,
            'is_main' => isset($data['is_main']),
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
                        ["icon" => "", "title" => "Categorias", "url" => route('categories.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = category::find($id);

        if(empty($item))
            return redirect()->back();

        return view('categories.edit', compact('headers', 'titles', 'item'));
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

        $slug = str_slug($data['name'], '-');

        $countSlug = Category::where('slug', $slug)->where('id', '!=', $id)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $category = Category::find($id)->update([
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $fileName,
            'is_main' => isset($data['is_main']),
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
        ]);

        return redirect()->route('categories.index')->with('message', 'Registro atualizado com sucesso!');
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

        Category::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function upload($file){
        $newName = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $fileName = "{$newName}.{$extension}";

        $upload = $file->storeAs('categories', $fileName);
      
        if ( !$upload )
            return false;

        return $fileName;   
    }
}
