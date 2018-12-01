<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attachment extends Model
{

	protected $fillable = [
			'name', 'value', 'lesson_id'
	];



    public static function listItems($paginate, $lessonId = null, $search = null)
	{
		if($search){
			$items = DB::table('attachments')
					->select('id', 'name', 'value')
					->whereRaw("lesson_id = $lessonId")
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})                        
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('attachments')
					->select('id', 'name', 'value')
					->whereRaw("lesson_id = $lessonId")
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}
}
