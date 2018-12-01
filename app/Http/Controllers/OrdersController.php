<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\RestrictedController;

use App\Order;
use App\Module;

class OrdersController extends RestrictedController
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
                    "Vendas",
                    [["icon" => "", "title" => "Vendas", "url" => ""]]
                );
        
        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Data", "Cliente", "Curso", "Valor", "Pagamento", "Acesso"]);
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
          $items = Order::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = Order::listItems($items_per_page);
        }

        foreach ($items as $key => $value) {
            $items[$key]->available = [
              "type" => 'label',
              "status" => $value->available == 0 ? 'warning' : 'success',
              "text"=> $value->available == 0 ? 'Indisponível' : 'Disponível'
            ];

            $status_name = Order::$status_names[$value->status];
            $items[$key]->status = [
              "type" => 'label',
              "status" => $status_name['type'],
              "text"=> $status_name['text']
            ];

            $items[$key]->price = 'R$ ' . number_format($value->price/100, 2, ',', '.');
            
            $items[$key]->created_at = mask_datetime($value->created_at, false);
        }

        return view('orders.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
    }

    private function validation(array $data, $action = 'store'){
      return Validator::make($data, [
        'status' => 'required|numeric',
        'end' => 'required',
      ]);
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

        $countSlug = Order::where('slug', $slug)->count(); 
        if($countSlug > 0)
            $slug .= "-$countSlug";

        $order = Order::create([
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
                    "Vendas",
                    [
                        ["icon" => "", "title" => "Vendas", "url" => route('orders.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = Order::find($id);
        $client = $item->client()->get();
        $client = $client[0];

        $course = $item->course()->get();
        $course = $course[0];

        $status_select = [];
        foreach (Order::$status_names as $key => $value) {
          array_push($status_select, [
            "value" => $key,
            "label" => $value['text']
          ]);
        }
        $status_select = json_encode($status_select);

        if(empty($item))
            return redirect()->back();

        return view('orders.edit', compact('headers', 'titles', 'item', 'client', 'course', 'status_select'));
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

        $order = Order::find($id)->update([
            'status' => $data['status'],
            'end' => mask_date($data['end'], true),
            'available' => isset($data['available'])
        ]);

        return redirect()->route('orders.index')->with('message', 'Registro atualizado com sucesso!');
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

        Order::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function upload($file){
        $newName = uniqid(date('HisYmd'));
        $extension = $file->extension();
        $fileName = "{$newName}.{$extension}";

        $upload = $file->storeAs('orders', $fileName);
      
        if ( !$upload )
            return false;

        return $fileName;   
    }
}
