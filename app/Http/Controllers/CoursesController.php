<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Course;
use App\Category;
use App\Level;
use App\Teacher;

class CoursesController extends RestrictedController
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
        $titles = json_encode(["#", "Imagem", "Nome", "Status", "Valor"]);
        $actions = json_encode([
            [  
                'path' => '{item}/chapters',
                'icon' => 'fa fa-file',
                'label' => 'Capítulos',
                'color' => 'default'
            ],
            [  
                'path' => '{item}/edit',
                'icon' => 'fa fa-pencil',
                'label' => 'Editar Item',
                'color' => 'primary'
            ]
        ]);
        
        if(!empty($request->busca)){
          $busca = $request->busca;
          $items = Course::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = Course::listItems($items_per_page);
        }

        foreach ($items as $key => $value) {
            if(strlen($value->image) > 0){
              $items[$key]->image = [
                  "type" => 'img',
                  "src"=> asset('storage/courses/'. $value->image)
              ];
            }else{
              $items[$key]->image = 'Sem foto';
            }

            $items[$key]->active = [
              "type" => 'label',
              "status" => $value->active == 0 ? 'danger' : 'success',
              "text"=> $value->active == 0 ? 'Desativado' : 'Ativo'
            ];

            $items[$key]->price = 'R$ ' . ($value->promotion_active == 1 ? number_format($value->promotional_price/100, 2, ',', '.') : number_format($value->price/100, 2, ',', '.'));
            unset($items[$key]->promotional_price);
            unset($items[$key]->promotion_active);
        }

        $categories = json_encode(Category::select('id AS value','name AS label')->get());
        $levels = json_encode(Level::select('id AS value','name AS label')->get());
        $teachers = json_encode(Teacher::select('id AS value','name AS label')->get());

        return view('courses.index', compact('headers', 'titles', 'items', 'busca', 'categories', 'levels', 'actions', 'teachers'));
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

        if($request->hasFile('image') && $request->image->isValid()){
            $fileName = $this->upload($request->image);
          
            if ( !$fileName )
                return redirect()->back()->withErrors($validation)->withInput();
        }

        $slug = str_slug($data['name'], '-');

        $countSlug = Course::where('slug', $slug)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $course = Course::create([
            'category_id' => $data['category_id'],
            'level_id' => $data['level_id'],
            'teacher_id' => $data['teacher_id'],
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $fileName,
            'lead' => isset($data['lead']) ? $data['lead'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'details_title' => isset($data['details_title']) ? $data['details_title'] : null,
            'details_description' => isset($data['details_description']) ? $data['details_description'] : null,
            'active' => isset($data['active']),
            'price' => $data['price'] * 100,
            'promotion_active' => isset($data['promotion_active']),
            'promotional_price' => $data['promotional_price'] * 100,
            'promotional_phrase' => $data['promotional_phrase'],
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
                        ["icon" => "", "title" => "Categorias", "url" => route('courses.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = course::find($id);

        if(empty($item))
            return redirect()->back();

        $categories = json_encode(Category::select('id AS value','name AS label')->get());
        $levels = json_encode(Level::select('id AS value','name AS label')->get());
        $teachers = json_encode(Teacher::select('id AS value','name AS label')->get());

        return view('courses.edit', compact('headers', 'titles', 'item', 'categories', 'levels', 'teachers'));
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

        $countSlug = Course::where('slug', $slug)->where('id', '!=', $id)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $course = Course::find($id)->update([
            'category_id' => $data['category_id'],
            'level_id' => $data['level_id'],
            'teacher_id' => $data['teacher_id'],
            'name' => $data['name'],
            'slug' => $slug,
            'image' => $fileName,
            'lead' => isset($data['lead']) ? $data['lead'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'details_title' => isset($data['details_title']) ? $data['details_title'] : null,
            'details_description' => isset($data['details_description']) ? $data['details_description'] : null,
            'active' => isset($data['active']),
            'price' => $data['price'] * 100,
            'promotion_active' => isset($data['promotion_active']),
            'promotional_price' => $data['promotional_price'] * 100,
            'promotional_phrase' => $data['promotional_phrase'],
        ]);

        return redirect()->route('courses.index')->with('message', 'Registro atualizado com sucesso!');
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

        Course::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function upload($file){
        $newName = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $fileName = "{$newName}.{$extension}";

        $upload = $file->storeAs('courses', $fileName);
      
        if ( !$upload )
            return false;

        return $fileName;   
    }

    private function validation(array $data, $action = 'store'){
      if($action == 'update'){
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'price' => 'required|numeric',
          'category_id' => 'required',
          'teacher_id' => 'required',
          'level_id' => 'required',
        ]);
      }else{
        return Validator::make($data, [
          'name' => 'required|string|max:255',
          'price' => 'required|numeric',
          'image' => 'required|mimes:jpeg,bmp,png',
          'teacher_id' => 'required',
          'category_id' => 'required',
          'level_id' => 'required',
        ]);
      }
    }

    public function setActive(Request $request, $id)
    {
        $data = $request->all();
        
        $item = Course::find($id);

        if($item->active == 0){
          $status = "Ativo";
          $value = 1;
        }else{
          $status = "Desativado";
          $value = 0;
        }

        $item->update([
            'active' => $value
        ]);

        return response()->json(['success' => ['status' => $status]], $this->successStatus)
                ->header('Content-Type', 'application/json; charset=UTF-8');
    }
}
