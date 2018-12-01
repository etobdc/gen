<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configs extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'keywords', 'description', 'facebook', 'linkedin', 'instagram', 'endereco', 'latitude', 'longitude', 'telefone', 'telefone_2', 'telefone_3', 'email'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('configs')
					->select('id','name')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','ASC')
					->paginate($paginate);
		}else{
			$items = DB::table('configs')
					->select('id','name')
					->orderBy('id','ASC')
					->paginate($paginate);
		}

		return $items;
	}
}
