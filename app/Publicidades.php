<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publicidades extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'titulo', 'local', 'link', 'image'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('publicidades')
					->select('id','name','image')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('publicidades')
					->select('id','name','image')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}
}
