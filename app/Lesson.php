<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lesson extends Model
{

	protected $fillable = [
			'name', 'description', 'order', 'slug', 'chapter_id', 'video'
	];



    public static function listItems($paginate, $chapterId = null, $search = null)
	{
		if($search){
			$items = DB::table('lessons')
					->select('id', 'name', 'order', 'active')
					->whereRaw("chapter_id = $chapterId")
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})                        
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('lessons')
					->select('id', 'name', 'order', 'active')
					->whereRaw("chapter_id = $chapterId")
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	/**
     * The module's submodules
     */
    public function attachments()
    {
        return $this->hasMany('App\Attachment', 'lesson_id');
    }
}
