<?php

namespace App\Http\Controllers\Courses;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Chapter;

class ChaptersController extends RestrictedController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $courseId)
    {
      #PAGE TITLE E BREADCRUMBS
      $headers = parent::headers(
                  "Capítulos",
                  [
                    ["icon" => "", "title" => "Cursos", "url" => route('courses.index')],
                    ["icon" => "", "title" => "Capítulos", "url" => ""]
                  ]
              );
      
      #LISTA DE ITENS
      $items_per_page = config('constants.options.items_per_page');
      $titles = json_encode(["#", "Nome", "Ordem", "Ativo"]);
      $actions = json_encode([
            [  
                'path' => '{item}/lessons',
                'icon' => 'fa fa-slideshare',
                'label' => 'Aulas',
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
        $items = Chapter::listItems($items_per_page, $courseId, $busca);
      }else{
        $busca = "";
        $items = Chapter::listItems($items_per_page, $courseId);
      }

      foreach ($items as $key => $value) {
        $items[$key]->active = [
          "type" => 'label',
          "status" => $value->active == 0 ? 'danger' : 'success',
          "text"=> $value->active == 0 ? 'Desativado' : 'Ativo'
        ];
      }

      return view('courses.chapters.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'courseId'));
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
    public function store(Request $request, $courseId)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'store');
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $slug = str_slug($data['name'], '-');

        $countSlug = Chapter::where('slug', $slug)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        Chapter::create([
            'course_id'  => $courseId,
            'name' => $data['name'],
            'slug' => $slug,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
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
    public function edit($courseId, $id)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
                    "Chapters",
                    [
                        ["icon" => "", "title" => "Cursos", "url" => route('courses.index')],
                        ["icon" => "", "title" => "Chapters", "url" => route('courses.chapters.index', $courseId)],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = Chapter::find($id);

        if(empty($item))
            return redirect()->back();

        return view('courses.chapters.edit', compact('headers', 'titles', 'item', 'trails', 'courseId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseId, $id)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'update');

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $slug = str_slug($data['name'], '-');

        $countSlug = Chapter::where('slug', $slug)->where('id', '!=', $id)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        Chapter::find($id)->update([
            'course_id'  => $courseId,
            'name' => $data['name'],
            'slug' => $slug,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
        ]);

        return redirect()->route('courses.chapters.index', $courseId)->with('message', 'Registro atualizado com sucesso!');
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
        Chapter::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function validation(array $data, $action){
        return Validator::make($data, [
                'name' => 'required',
                'order' => 'required',
        ]);
    }
}