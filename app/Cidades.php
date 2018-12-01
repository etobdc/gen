<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cidades extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'uf'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('cidades')
					->select('id','name')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','ASC')
					->paginate($paginate);
		}else{
			$items = DB::table('cidades')
					->select('id','name')
					->orderBy('id','ASC')
					->paginate($paginate);
		}

		return $items;
	}
}
