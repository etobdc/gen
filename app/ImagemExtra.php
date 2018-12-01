<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImagemExtra extends Model
{
  /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'image', 'imovel_id'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public static function listItems($paginate, $imovelId = null, $search = null)
	{

		if($search){
			$items = DB::table('imagem_extras')
					->select('id', 'image')
					->whereRaw("imovel_id = $imovelId")
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%');
					})
					->orderBy('id','ASC')
					->paginate($paginate);
		}else{
			$items = DB::table('imagem_extras')
					->select('id','image')
					->where("imovel_id",$imovelId)
					->paginate($paginate);
		}
		return $items;
	}
}
