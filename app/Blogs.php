<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blogs extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'slug', 'lead', 'description', 'image', 'thumbnail'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('blogs')
					->select('id','name')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('blogs')
					->select('id','name')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	public static function showPage()
	{
		$items = DB::table('pages')
			->select('id','title', 'description')
			->where('id', '=', 8)
			->get();
		
		return $items;
	}
}
