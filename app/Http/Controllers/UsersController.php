<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
Use App\Http\Controllers\RestrictedController;

use App\User;
use App\Group;

class UsersController extends RestrictedController
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
                    "Usuários",
                    [["icon" => "", "title" => "Usuários", "url" => ""]]
                );
        
        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Nome", "E-mail", "Usuário"]);
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
          $items = User::listItems($items_per_page,$busca);
        }else{
          $busca = "";
          $items = User::listItems($items_per_page);
        }

        $groups = json_encode(Group::select('id AS value','name AS label')->get());

        return view('users.index', compact('headers', 'titles', 'items', 'groups', 'busca', 'actions'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validation(array $data, $action)
    {
        if($action == 'store')
        {
            return Validator::make($data, [
                'group_id' => 'required|integer',
                'icon' => 'mimes:jpeg,bmp,png',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6'
                ]);
        }
        elseif($action == 'update'){
            if(strlen($data['password']) > 0){
                return Validator::make($data, [
                    'group_id' => 'required|integer',
                    'icon' => 'mimes:jpeg,bmp,png',
                    'name' => 'required|string|max:255',
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($data['id'])],
                    'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($data['id'])],
                    'password' => 'required|string|min:6'
                ]);
            }else{
                return Validator::make($data, [
                    'group_id' => 'required|integer',
                    'icon' => 'mimes:jpeg,bmp,png',
                    'name' => 'required|string|max:255',
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($data['id'])],
                    'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($data['id'])]
                ]);
            }

        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    private function create(array $data)
    {
        
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
            $fileName = $this->upload($request);
            if(!$fileName)
                return redirect()->back()->withErrors($validation)->withInput();
        }else{
            $fileName = null;
        }

       User::create([
            'group_id' => $data['group_id'],
            'image' => $fileName,
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'type' => 0
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
    public function edit($id)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
                    "Usuários",
                    [
                        ["icon" => "", "title" => "Usuários", "url" => route('users.index')],
                        ["icon" => "", "title" => "Editar", "url" => ""]
                    ]
                );

        $item = user::find($id);     

        if(empty($item))
            return redirect()->back();

        $groups = json_encode(Group::select('id AS value','name AS label')->get());

        return view('users.edit', compact('headers', 'titles', 'item', 'groups'));
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
        $data = array_merge($data, ["id" => $id]); //Used on validation

        $validation = $this->validation($data, 'update');
        if($validation->fails())
          return redirect()->back()->withErrors($validation)->withInput();

        if($request->hasFile('image') && $request->image->isValid()){

            $fileName = $this->upload($request);
            if(!$fileName)
                return redirect()->back()->withErrors($validation)->withInput();

            $image = $fileName;
        }elseif(!empty($data['remove-image'])){
            $image = '';
        }else{
            $image = $data['old-image'];
        }

        if(strlen($data['password']) > 0){
            User::find($id)->update([
                            'name' => $data['name'],
                            'image' => $image,
                            'group_id' => $data['group_id'],
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'username' => $data['username'],
                            'password' => bcrypt($data['password'])
                        ]);
        }else{
            User::find($id)->update([
                            'name' => $data['name'],
                            'image' => $image,
                            'group_id' => $data['group_id'],
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'username' => $data['username']
                        ]);
        }      
        
        return redirect()->route('users.index')->with('message', 'Registro atualizado com sucesso!');
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

        User::whereIn('id',$data['registro'])->delete();
        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    private function upload(Request $request){
        $newName = uniqid(date('HisYmd'));
        $extension = $request->image->extension();
        $fileName = "{$newName}.{$extension}";

        $upload = $request->image->storeAs('users', $fileName);
      
        if ( !$upload )
            return false;

        return $fileName;   
    }
}
