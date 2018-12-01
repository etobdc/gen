<?php

namespace App\Http\Controllers\Courses\Chapters;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Lesson;

class LessonsController extends RestrictedController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $courseId, $chapterId)
    {
      #PAGE TITLE E BREADCRUMBS
      $headers = parent::headers(
                  "Aulas",
                  [
                    ["icon" => "", "title" => "Cursos", "url" => route('courses.index')],
                    ["icon" => "", "title" => "Capítulos", "url" => route('courses.chapters.index', $courseId)],
                    ["icon" => "", "title" => "Aulas", "url" => ""]
                  ]
              );
      
      #LISTA DE ITENS
      $items_per_page = config('constants.options.items_per_page');
      $titles = json_encode(["#", "Nome", "Ordem", "Ativo"]);
      $actions = json_encode([
            [  
                'path' => '{item}/attachments',
                'icon' => 'fa fa-paperclip',
                'label' => 'Anexos',
                'color' => 'default'
            ],
            [  
                'path' => '{item}/edit',
                'icon' => 'fa fa-pencil',
                'label' => 'Editar Item',
                'color' => 'primary'
            ]
        ]);
      $routeIds = [
            $courseId,
            $chapterId
      ];
      
      if(!empty($request->busca)){
        $busca = $request->busca;
        $items = Lesson::listItems($items_per_page, $chapterId, $busca);
      }else{
        $busca = "";
        $items = Lesson::listItems($items_per_page, $chapterId);
      }

      foreach ($items as $key => $value) {
        $items[$key]->active = [
          "type" => 'label',
          "status" => $value->active == 0 ? 'danger' : 'success',
          "text"=> $value->active == 0 ? 'Desativado' : 'Ativo'
        ];
      }

      return view('courses.chapters.lessons.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'routeIds'));
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
    public function store(Request $request, $courseId, $chapterId)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'store');
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $slug = str_slug($data['name'], '-');

        $countSlug = Lesson::where('slug', $slug)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        Lesson::create([
            'chapter_id'  => $chapterId,
            'name' => $data['name'],
            'video' => empty($data['video']) ? '' : $data['video'],
            'slug' => $slug,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
        ]);

        return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseId, $chapterId, $id)
    {
        #PAGE TITLE E BREADCRUMBS
        $routeIds = [ $courseId, $chapterId ];
        $formIds = [ $courseId, $chapterId, $id ];
        $headers = parent::headers(
                    "Aulas",
                    [
                        ["icon" => "", "title" => "Cursos", "url" => route('courses.index')],
                        ["icon" => "", "title" => "Capítulos", "url" => route('courses.chapters.index', $courseId)],
                        ["icon" => "", "title" => "Aulas", "url" => route('courses.chapters.lessons.index', $routeIds)],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );


        $item = Lesson::find($id);

        if(empty($item))
            return redirect()->back();

        return view('courses.chapters.lessons.edit', compact('headers', 'titles', 'item', 'trails', 'routeIds', 'formIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseId, $chapterId, $id)
    {
        #PAGE TITLE E BREADCRUMBS
        $routeIds = [ $courseId, $chapterId ];
        $formIds = [ $courseId, $chapterId, $id ];

        $data = $request->all();

        $validation = $this->validation($data, 'update');

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $slug = str_slug($data['name'], '-');

        $countSlug = Lesson::where('slug', $slug)->where('id', '!=', $id)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        Lesson::find($id)->update([
            'chapter_id'  => $chapterId,
            'name' => $data['name'],
            'video' => empty($data['video']) ? '' : $data['video'],
            'slug' => $slug,
            'description' => isset($data['description']) ? $data['description'] : null,
            'order' => isset($data['order']) ? $data['order'] : 0,
        ]);

        return redirect()->route('courses.chapters.lessons.index', $routeIds)->with('message', 'Registro atualizado com sucesso!');
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
        Lesson::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function validation(array $data, $action){
        return Validator::make($data, [
                'name' => 'required',
                'order' => 'required',
        ]);
    }
}