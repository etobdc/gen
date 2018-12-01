<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configuration extends Model
{
    protected $fillable = ['value'];

    public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('configurations')
					->select('id','name')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})                        
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('configurations')
					->select('id','name')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}
}
