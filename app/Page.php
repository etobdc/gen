<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'title', 'description', 'image'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('pages')
				->select('id','name')
				->where(function($query) use ($search){
					$query->orWhere('id','like','%'.$search.'%')
						->orWhere('name','like','%'.$search.'%');
				})
				->orderBy('id','ASC')
				->paginate($paginate);
		}else{
			$items = DB::table('pages')
				->select('id','name')
				->orderBy('id','ASC')
				->paginate($paginate);
		}

		return $items;
	}

	public static function listpage($item)
	{
		$items = DB::table('pages')
			->select('title','description', 'image')
			->whereIn('id', $item)
			->get();

		return $items;
	}
}
