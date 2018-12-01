<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
Use App\Http\Controllers\RestrictedController;

use App\Client;
use App\User;
use App\Order;

class ClienTscontroller extends RestrictedController
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
								"Clientes",
								[["icon" => "", "title" => "Clientes", "url" => ""]]
						);
		
		#LISTA DE ITENS
		$items_per_page = config('constants.options.items_per_page');
		$titles = json_encode(["#", "Nome", "E-mail", "CPF"]);
		$actions = json_encode([
            [  
                'path' => '{item}',
                'icon' => 'fa fa-eye',
                'label' => 'Detalhes',
                'color' => 'default'
            ],
            [  
                'path' => '{item}/edit',
                'icon' => 'fa fa-pencil',
                'label' => 'Editar Item',
                'color' => 'primary'
            ]
        ]);
		
		if(!empty($request->search)){
			$search = $request->search;
			$items = Client::list($items_per_page,$search);
		}else{
			$search = "";
			$items = Client::list($items_per_page);
		}

		foreach ($items as $key => $value) {
			$items[$key]->cpf = mask_cpf($value->cpf);
		}

		return view('clients.index', compact('headers', 'titles', 'items', 'search', 'actions'));
	}

	private function validation(array $data)
    {
        if(empty($data['password'])){
        return Validator::make($data, [
                'name' => 'required|string|max:255|regex:/[A-Z][a-z]* [A-Z][a-z]*/',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clients')->ignore($data['id'])],
                'cpf' => ['required', 'string', 'min:11', 'max:11', 'regex:/^[\w-]*$/', Rule::unique('clients')->ignore($data['id'])],
                'birthdate' => 'required|date',
                'phone' => 'required|regex:/^[\w-]*$/|min:10|max:11',
                'zipcode' => 'required|max:10',
                'street' => 'required|max:50',
                'number' => 'required|max:20',
                'district' => 'required|max:50',
                'city' => 'required|max:255',
                'state' => 'required|max:2',
            ]);
        }else{
            return Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clients')->ignore($data['id'])],
                'cpf' => ['required', 'string', 'min:11', 'max:11', 'regex:/^[\w-]*$/', Rule::unique('clients')->ignore($data['id'])],
                'birthdate' => 'required|date',
                'phone' => 'required|regex:/^[\w-]*$/|min:10|max:11',
                'zipcode' => 'required|max:10',
                'street' => 'required|max:50',
                'number' => 'required|max:20',
                'district' => 'required|max:50',
                'city' => 'required|max:255',
                'state' => 'required|max:2',
                'password' => 'required|min:6'
            ]);
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		#PAGE TITLE E BREADCRUMBS
		$headers = parent::headers(
								"Clientes",
								[
										["icon" => "", "title" => "Clientes", "url" => route('clients.index')],
										["icon" => "", "title" => "Ver", "url" => ""]
								]
						);

		$item = Client::find($id);     

		if(empty($item))
				return redirect()->back();

		$orders = $item->orders()->with('course')->get();

		foreach ($orders as $key => $value) {
			$orders[$key]->available = [
              "status" => $value->available == 0 ? 'warning' : 'success',
              "text"=> $value->available == 0 ? 'Indisponível' : 'Disponível'
            ];

            $status_name = Order::$status_names[$value->status];
            $orders[$key]->status = [
              "status" => $status_name['type'],
              "text"=> $status_name['text']
            ];
		}

		return view('clients.show', compact('headers', 'titles', 'item', 'orders'));
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
							"Clientes",
							[
								["icon" => "", "title" => "Clientes", "url" => route('clients.index')],
								["icon" => "", "title" => "Editar", "url" => ""]
							]
						);

		$item = Client::find($id);     

		if(empty($item))
				return redirect()->back();

		return view('clients.edit', compact('headers', 'titles', 'item'));
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$data = array_merge($data, ["id" => $id]); //Used on validation

		$data = $this->format_data($data);

		$validation = $this->validation($data);
		if($validation->fails())
			return redirect()->back()->withErrors($validation)->withInput();

		$item = Client::find($id);

		$item->update([
			'email' => $data['email'],
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'birthdate' => $data['birthdate'],
            'secondary_phone' => empty($data['secondary_phone']) ? '' : $data['secondary_phone'],
            'phone' => empty($data['phone']) ? '' : $data['phone'],
            'zipcode' => $data['zipcode'],
            'street' => $data['street'],
            'number' => $data['number'],
            'complement' => empty($data['complement']) ? '' : $data['complement'],
            'district' => $data['district'],
            'city' => $data['city'],
            'state' => $data['state'],
		]);

		if(empty($data['password'])){
			User::find($item->user_id)->update([
				'name' => $data['name'],
	            'email' => $data['email'],
	            'username' => $data['cpf']
			]);
		}else{
			User::find($item->user_id)->update([
				'name' => $data['name'],
	            'email' => $data['email'],
	            'username' => $data['cpf'],
	            'password' => bcrypt($data['password'])
			]);
		}      
		
		return redirect()->route('clients.index')->with('message', 'Registro atualizado com sucesso!');
	}

	public function format_data($data)
	{
		if(!empty($data['cpf'])) $data['cpf'] = mask_cpf($data['cpf'], true);
		if(!empty($data['phone'])) $data['phone'] = mask_phone($data['phone'], true);
		if(!empty($data['secondary_phone'])) $data['secondary_phone'] = mask_phone($data['secondary_phone'], true);
		if(!empty($data['birthdate'])) $data['birthdate'] = mask_date($data['birthdate'], true);
		
		return $data;
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

		$clients = Client::whereIn('id', $data['registro'])->get();

		$id_users = [];
		foreach ($clients as $key => $value) {
			array_push($id_users, $value->user_id);
		}

		User::whereIn('id', $id_users)->delete();
		Order::whereIn('client_id', $id_users)->delete();
		Client::whereIn('id',$data['registro'])->delete();
		return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
	}
}
