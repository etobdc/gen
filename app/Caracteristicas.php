<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Caracteristicas extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name','quantidade','imovel_id'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $courseId = null, $search = null)
	{
		if($search){
			$items = DB::table('caracteristicas')
					->select('id', 'name')
					->whereRaw("imovel_id = $courseId")
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','ASC')
					->paginate($paginate);
		}else{
			$items = DB::table('caracteristicas')
					->select('id', 'name')
					->whereRaw("imovel_id = $courseId")
					->orderBy('id','ASC')
					->paginate($paginate);
		}

		return $items;
	}
}
