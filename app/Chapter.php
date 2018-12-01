<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chapter extends Model
{

	protected $fillable = [
			'name', 'description', 'order', 'slug', 'course_id'
	];



  public static function listItems($paginate, $courseId = null, $search = null)
	{
		if($search){
			$items = DB::table('chapters')
					->select('id', 'name', 'order', 'active')
					->whereRaw("course_id = $courseId")
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%');
					})
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('chapters')
					->select('id', 'name', 'order', 'active')
					->whereRaw("course_id = $courseId")
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	/**
     * The module's submodules
     */
    public function lessons()
    {
        return $this->hasMany('App\Lesson', 'chapter_id');
    }
}
