<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'description', 'order', 'slug', 'image', 'is_main'
	];

	protected $hidden = [
			'active', 'created_at', 'updated_at'
	];
		
	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('categories')
					->select('id','name')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})               
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('categories')
					->select('id','name')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	/**
     * The module's submodules
     */
    public function courses()
    {
        return $this->hasMany('App\Course', 'category_id')->where('active', 1);
    }
}
