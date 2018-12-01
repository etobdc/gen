<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'telefone', 'image'
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	public static function showPage()
	{
		$items = DB::table('pages')
			->select('id', 'title', 'description')
			->where('id', '=', 9)
			->get();
	
		return $items;
	}

	public static function listRealtors()
	{
		$items = DB::table('corretores')
			->select('name', 'email', 'telefone', 'image')
			->get();
	
		return $items;
	}
}
