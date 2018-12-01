<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Imovel;
use App\Tipos;
use App\Cidades;
use App\Bairros;

use App\Traits;

class ImovelController extends RestrictedController
{

    use Traits\SlugTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       #PAGE TITLE E BREADCRUMBS
       $headers = parent::headers(
                   "Imovel",
                   [["icon" => "", "title" => "Imovel", "url" => ""]]
               );
       #LISTA DE ITENS
       $items_per_page = config('constants.options.items_per_page');
       $titles = json_encode(["#", "Nome", "Código"]);
       $actions = json_encode([
           [
               'path' => '{item}/edit',
               'icon' => 'fa fa-pencil',
               'label' => 'Editar Imóvel',
               'color' => 'primary'
           ],
          //  [
          //      'path' => '{item}/caracteristicas',
          //      'icon' => 'fa fa-home',
          //      'label' => 'Adicionar característica',
          //      'color' => 'success'
          //  ],
           [
               'path' => '{item}/imagens',
               'icon' => 'fa fa-picture-o',
               'label' => 'Adicionar imagens',
               'color' => 'success'
           ]
       ]);
       if(!empty($request->busca)){
         $busca = $request->busca;
         $items = Imovel::listItems($items_per_page,$busca);
       }else{
         $busca = "";
         $items = Imovel::listItems($items_per_page);
       }

       $tipos = json_encode(Tipos::select('id AS value','name AS label')->get());
       $cidades = json_encode($this->getCidades());
       $bairros = json_encode(Bairros::select('id AS value','name AS label', 'cidade_id')->get());

       return view('imovel.index', compact('headers', 'titles', 'items', 'tipos', 'busca', 'cidades', 'bairros', 'actions'));
     }

     private function validation(array $data, $action = 'store'){
       if($action == 'update'){
         return Validator::make($data, [
           'name' => 'required|string|max:150',
           'codigo' => 'required|string|max:25',
           'status' => 'required|integer',
           'tipo_id' => 'required|integer',
           'cidade_id' => 'required|integer',
           'bairro_id' => 'required|integer',
           'area' => 'nullable|integer',
           'quarto' => 'nullable|integer',
           'garagem' => 'nullable|integer',
           'banheiro' => 'nullable|integer',
           'sala' => 'nullable|integer',
           'endereco' => 'required|string',
           'description' => 'required|string',
           'image' => 'nullable|image',
           'banner' => 'nullable|image',
           'video' => 'nullable|string|max:100'
         ]);
       }else{
         return Validator::make($data, [
           'name' => 'required|string|max:150',
           'codigo' => 'required|string|max:25',
           'status' => 'required|integer',
           'tipo_id' => 'required|integer',
           'cidade_id' => 'required|integer',
           'bairro_id' => 'required|integer',
           'area' => 'nullable|integer',
           'quarto' => 'nullable|integer',
           'garagem' => 'nullable|integer',
           'banheiro' => 'nullable|integer',
           'sala' => 'nullable|integer',
           'endereco' => 'required|string',
           'description' => 'required|string',
           'image' => 'required|image',
           'banner' => 'required|image',
           'video' => 'nullable|string|max:100'
         ]);
       }
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
       if($validation->fails())
         return redirect()->back()->withErrors($validation)->withInput();

       $image = '';
       if($request->hasFile('image') && $request->image->isValid()){
           $image = $this->upload($request->image);

           if ( !$image )
               return redirect()->back()->withErrors($validation)->withInput();
       }

       $banner = '';
       if($request->hasFile('banner') && $request->banner->isValid()){
           $banner = $this->upload($request->banner);

           if ( !$banner )
               return redirect()->back()->withErrors($validation)->withInput();
       }

       $slug = $this->getSlug($data['name'], 'imovels');

       $countSlug = Imovel::where('slug', $slug)->count();
       if($countSlug > 0)
           $slug .= "-$countSlug";

       $page = Imovel::create([
           'destaque' => !empty($data['destaque']) ? $data['destaque'] : 0,
           'name' => $data['name'],
           'codigo' => $data['codigo'],
           'slug' => $slug,
           'status' => $data['status'],
           'tipo_id' => $data['tipo_id'],
           'cidade_id' => $data['cidade_id'],
           'bairro_id' => $data['bairro_id'],
           'area' => $data['area'],
           'quarto' => $data['quarto'],
           'garagem' => $data['garagem'],
           'banheiro' => $data['banheiro'],
          //  'sala' => $data['sala'],
           'preco' => $data['preco'],
           'preco_adicionais' => $data['preco_adicionais'],
           'latitude' => $data['latitude'],
           'longitude' => $data['longitude'],
           'endereco' => $data['endereco'],
          //  'link_360' => $data['link_360'],
           'description' => !empty($data['description']) ? $data['description'] : null,
           'image' => $image,
           'banner' => $banner,
         'video' => !empty($data['video']) ? $data['video'] : null
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
                   "Imovel",
                   [
                       ["icon" => "", "title" => "Imovel", "url" => route('imovel.index')],
                       ["icon" => "", "title" => "Editar", "url" => ""]
                   ]
               );

       $item = Imovel::find($id);
       $tipos = json_encode(Tipos::select('id AS value','name AS label')->get());
       $cidades = json_encode($this->getCidades());
       $bairros = json_encode(Bairros::select('id AS value','name AS label', 'cidade_id')->get());

       if(empty($item))
           return redirect()->back();

       return view('imovel.edit', compact('headers', 'titles', 'item', 'tipos', 'cidades', 'bairros'));
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

       $imovel = Imovel::find($id);

       $validation = $this->validation($data, 'update');
       if($validation->fails())
         return redirect()->back()->withErrors($validation)->withInput();

       $image = '';
       if($request->hasFile('image') && $request->image->isValid()){
         $image = $this->upload($request->image);

         if ( !$image )
           return redirect()->back()->withErrors($validation)->withInput();
       }else{
         if(!empty($data['old-image']))
           $image = $data['old-image'];
       }

       $banner = '';
       if($request->hasFile('banner') && $request->banner->isValid()){
         $banner = $this->upload($request->banner);

         if ( !$banner )
           return redirect()->back()->withErrors($validation)->withInput();
       }else{
         if(!empty($data['old-banner']))
           $banner = $data['old-banner'];
       }

       $slug = $imovel->slug;
       if($slug !== str_slug($data['name'], '-')){
          $slug = $this->getSlug($data['name'], 'imovels');
        }

        if(empty($data['destaque']))
          $data['destaque'] = 0;

       $page = $imovel->update([
         'destaque' => !empty($data['destaque']) ? $data['destaque'] : 0,
         'name' => $data['name'],
         'slug' => $slug,
         'codigo' => $data['codigo'],
         'status' => $data['status'],
         'tipo_id' => $data['tipo_id'],
         'cidade_id' => $data['cidade_id'],
         'bairro_id' => $data['bairro_id'],
         'area' => $data['area'],
         'quarto' => $data['quarto'],
         'garagem' => $data['garagem'],
         'banheiro' => $data['banheiro'],
         'preco' => $data['preco'],
         'preco_adicionais' => $data['preco_adicionais'],
         'latitude' => $data['latitude'],
         'longitude' => $data['longitude'],
         'endereco' => $data['endereco'],
        //  'link_360' => $data['link_360'],
         'description' => $data['description'],
         'image' => $image,
         'banner' => $banner,
         'video' => $data['video']
       ]);

       return redirect()->route('imovel.index')->with('message', 'Registro atualizado com sucesso!');
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

       Imovel::whereIn('id',$data['registro'])->delete();
       return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
     }

     private function upload($file){
       $newName = uniqid(date('HisYmd'));
       $extension = $file->extension();
       $fileName = "{$newName}.{$extension}";

       $upload = $file->storeAs('imovel', $fileName);

       if ( !$upload )
           return false;

       return $fileName;
   }

   private function getCidades(){
    $cidades = Cidades::select('id AS value','name','uf')->get();
    foreach ($cidades as $key => $value) {
      $value->label = $value->name . ' - ' . $value->uf;
      unset($value->uf);
      unset($value->name);
    }     

    return $cidades;
   }
}
