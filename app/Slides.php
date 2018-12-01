<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slides extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'lead', 'image', 'link', 'link_title'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('slides')
					->select('id','name','image')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('slides')
					->select('id','name','image')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}
}
