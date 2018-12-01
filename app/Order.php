<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'course_id', 'client_id', 'start', 'end', 'status', 'price', 'moip_id', 'payment_url', 'available'
	];

	public static $status_names = [
		"0" => [
			"type" => "default",
			"text" => "Compra Iniciada"
		],
		"1" => [
			"type" => "primary",
			"text" => "Aguardando Pagamento"
		],
		"2" => [
			"type" => "success",
			"text" => "Pagamento Confirmado"
		],
		"9" => [
			"type" => "danger",
			"text" => "Pagamento Cancelado"
		]
	];
		
	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('orders')
					->select('orders.id','orders.created_at','clients.name as client_name','courses.name as course_name','orders.price','orders.status','orders.available')
					->join('clients', 'client_id', 'clients.id')
					->join('courses', 'course_id', 'courses.id')
					->where(function($query) use ($search){
						$query->orWhere('orders.id','like','%'.$search.'%')
									->orWhere('clients.name','like','%'.$search.'%')
									->orWhere('courses.name','like','%'.$search.'%')
									->orWhere(function($where) use ($search){
										if(strlen(preg_replace('/\D/', '', $search)) > 0){
											$where->where('orders.price','like','%'.$search.'%');
										}else{
											false;
										}
									});
					})                        
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('orders')
					->select('orders.id','orders.created_at','clients.name as client_name','courses.name as course_name','orders.price','orders.status','orders.available')
					->join('clients', 'client_id', 'clients.id')
					->join('courses', 'course_id', 'courses.id')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
}
