<?php

namespace App\Http\Controllers\Courses\Chapters\Lessons;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Attachment;

class AttachmentsController extends RestrictedController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $courseId, $chapterId, $lessonId)
    {
      #PAGE TITLE E BREADCRUMBS
        $routeIds = [$courseId, $chapterId];
        $formIds = [$courseId, $chapterId, $lessonId];
        $headers = parent::headers(
                    "Anexos",
                    [
                      ["icon" => "", "title" => "Cursos", "url" => route('courses.index')],
                      ["icon" => "", "title" => "Capítulos", "url" => route('courses.chapters.index', $courseId)],
                      ["icon" => "", "title" => "Aulas", "url" => route('courses.chapters.lessons.index', $routeIds)],
                      ["icon" => "", "title" => "Anexos", "url" => ""]
                    ]
                );
        
        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Nome", "Arquivo"]);
        $actions = json_encode([]);
      
      if(!empty($request->busca)){
        $busca = $request->busca;
        $items = Attachment::listItems($items_per_page, $lessonId, $busca);
      }else{
        $busca = "";
        $items = Attachment::listItems($items_per_page, $lessonId);
      }

      foreach ($items as $key => $value) {
          $items[$key]->value = [
              "type" => 'url',
              'target' => '_blank',
              "href"=> asset('storage/courses/attachments/'. $value->value),
              "label"=> asset('storage/courses/attachments/'. $value->value)
          ];
      }

      return view('courses.chapters.lessons.attachments.index', compact('headers', 'titles', 'items', 'trails', 'busca', 'actions', 'formIds', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $courseId, $chapterId, $lessonId)
    {
        $data = $request->all();

        $validation = $this->validation($data, 'store');
        if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput();
        }

        if($request->hasFile('value') && $request->value->isValid()){
          $fileName = $this->upload($request->value);
        
          if ( !$fileName )
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Attachment::create([
            'lesson_id'  => $lessonId,
            'name' => $data['name'],
            'value' => $fileName
        ]);

        return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
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
        Attachment::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function validation(array $data, $action = 'store'){
      return Validator::make($data, [
        'name' => 'required|string|max:255',
        'value' => 'required',
      ]);
    }

    private function upload($file){
        $newName = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $fileName = "{$newName}.{$extension}";

        $upload = $file->storeAs('courses/attachments', $fileName);
      
        if ( !$upload )
            return false;

        return $fileName;   
    }
}