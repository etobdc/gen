<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bairros extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name','cidade_id'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $courseId = null, $search = null)
	{
		if($search){
			$items = DB::table('bairros')
					->select('id', 'name')
					->whereRaw("cidade_id = $courseId")
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','ASC')
					->paginate($paginate);
		}else{
			$items = DB::table('bairros')
					->select('id', 'name')
					->whereRaw("cidade_id = $courseId")
					->orderBy('id','ASC')
					->paginate($paginate);
		}

		return $items;
	}
}
