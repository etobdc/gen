<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Imovel extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'destaque', 'name', 'codigo', 'slug', 'status','tipo_id', 'cidade_id', 'bairro_id', 'area', 'quarto', 'garagem','banheiro', 'sala', 'preco', 'preco_adicionais', 'latitude', 'longitude','endereco', 'description', 'link_360', 'image', 'video', 'banner'
	];

	protected $hidden = [
			'created_at', 'updated_at'
	];

	public $statusNames = [
		"1" => 'Á venda',
		"2" => 'Para Alugar',
		"3" => 'Lançamento'
	];

	public function getStatusName() {
		return $this->statusNames[$this->status];
	}

	public function tipos () {
		return $this->belongsTo('App\Tipos', 'tipo_id');
	}

	public function bairros () {
		return $this->belongsTo('App\Bairros', 'bairro_id');
	}

	public function cidades () {
		return $this->belongsTo('App\Cidades', 'cidade_id');
	}

	public function imagens_extra () {
		return $this->hasMany('App\ImagemExtra');
	}

	public static function listItems($paginate, $search = null)
	{
		if($search){
			$items = DB::table('imovels')
					->select('id','name','codigo')
					->where(function($query) use ($search){
						$query->orWhere('id','like','%'.$search.'%')
									->orWhere('name','like','%'.$search.'%')
									->orWhere('codigo','like','%'.$search.'%');
					})
					->orderBy('id','DESC')
					->paginate($paginate);
		}else{
			$items = DB::table('imovels')
					->select('id','name','codigo')
					->orderBy('id','DESC')
					->paginate($paginate);
		}

		return $items;
	}

	public static function listImoveisByCategory($search = null)
	{
		$items = DB::table('imovels')
			->select('name', 'slug', 'status', 'endereco', 'preco', 'image', 'preco', 'sala', 'banheiro', 'garagem', 'quarto', 'bairro_id', 'cidade_id', 'tipo_id', 'video')
			->where(function($query) use ($search){
				if (!empty($search['option'])) {
					$query->where('status', '=', $search['option']);
				}
				if (!empty($search['type'])) {
					$query->where('tipo_id', '=', $search['type']);
				}
				if (!empty($search['city'])) {
					$query->where('cidade_id', '=', $search['city']);
				}
				if (!empty($search['neighborhood'])) {
					$query->where('bairro_id', '=', $search['neighborhood']);
				}
				return true;
			})
			->get();

		return $items;
	}

	public static function listCities()
	{
		$items = DB::table('cidades')
			->select('id', 'name')
			->get();

		return $items;
	}

	public static function listNeighborhoods()
	{
		$items = DB::table('bairros')
			->select('id', 'name', 'cidade_id')
			->get();

		return $items;
	}

	public static function listTypes()
	{
		$items = DB::table('tipos')
			->select('id', 'name')
			->get();

		return $items;
	}

	public static function listBedrooms()
	{
		$items = DB::table('imovels')
			->select('quarto')
			->distinct('quarto')
			->orderBy('quarto')
			->get();

		return $items;
	}

	public static function listGarages()
	{
		$items = DB::table('imovels')
			->select('garagem')
			->distinct('garagem')
			->orderBy('garagem')
			->get();

		return $items;
	}

	public static function listBathrooms()
	{
		$items = DB::table('imovels')
			->select('banheiro')
			->distinct('banheiro')
			->orderBy('banheiro')
			->get();

		return $items;
	}

	public static function listLivingrooms()
	{
		$items = DB::table('imovels')
			->select('sala')
			->distinct('sala')
			->orderBy('sala')
			->get();

		return $items;
	}

	public static function showImovelDetails($slug)
	{
		$items = DB::table('imovels')
			->select('*')
			->where('slug', '=', $slug)
			->get();

		return $items;
	}

	public static function showImovelGalery($imovel_id)
	{
		$items = DB::table('imagem_extras')
			->select('image')
			->where('imovel_id', '=', $imovel_id)
			->get();

		return $items;
	}

	public static function listFeatured()
	{
		$items = DB::table('imovels')
			->select('name', 'slug', 'status', 'endereco', 'preco', 'image', 'preco', 'sala', 'banheiro', 'garagem', 'quarto', 'bairro_id', 'cidade_id', 'tipo_id', 'video')
			->where('destaque', '=', '2')
			->limit(3)
			->get();

		return $items;
	}
}
