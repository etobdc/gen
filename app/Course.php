<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_id', 'level_id', 'name','slug','image','lead','description','details_title','details_description','active','price','promotional_price','promotional_phrase','promotion_active','teacher_id'
	];
		
	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('courses')
					->select('id','image','name','active', 'price', 'promotional_price', 'promotion_active')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%')
									->orWhere(function($where) use ($search){
										if(strlen(preg_replace('/\D/', '', $search)) > 0){
											$where->where('price','like','%'.preg_replace('/\D/', '', $search).'%')
											->where('promotion_active','0');
										}else{
											false;
										}
									})
									->orWhere(function($where) use ($search){
										if(strlen(preg_replace('/\D/', '', $search)) > 0){
											$where->where('promotional_price','like','%'.preg_replace('/\D/', '', $search).'%')
											->where('promotion_active','1');
										}else{
											false;
										}
									});
									
					})                        
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('courses')
					->select('id','image','name','active', 'price', 'promotional_price', 'promotion_active')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	/**
     * The module's submodules
     */
    public function chapters()
    {
        return $this->hasMany('App\Chapter', 'course_id');
    }

    /**
     * The module's submodules
     */
    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id');
    }
}
