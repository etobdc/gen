<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Imovel;

class ImovelController extends Controller
{
    public function index (Request $request) {
     $perPage = 15;
     if($request->per_page){
       $perPage = $request->per_page;
     }
     $oderBy = 'vdesc';
     if($request->order_by){
       $oderBy = $request->order_by;
     }

     $imoveis = Imovel::where(function ($query) use ($request) {
            if($request->destaque !== null){
                $query->where('destaque', $request->destaque);
            }
            if($request->status !== null){
                $query->whereIn('status', explode(',', $request->status));
            }
            if($request->tipo !== null){
                $query->whereIn('tipo_id', explode(',', $request->tipo));
            }
            if($request->cidade !== null){
                $query->whereIn('cidade_id', explode(',', $request->cidade));
            }
            if($request->min !== null){
                $query->where('preco', '>=', $request->min);
            }
            if($request->max !== null){
                $query->where('preco', '<=', $request->max);
            }
            if($request->busca !== null){
                $buscaSPreposicao = str_ireplace ( array (
                " de ",
                " da ",
                " do ",
                " na ",
                " no ",
                " em ",
                " a ",
                " o ",
                " e ",
                " as ",
                " os "
                ), " ", $request->busca );
                $arrayBusca = explode(' ', $buscaSPreposicao);
                
                $buscaCidade = [];
                $buscaBairros = [];
                $buscaTipos = [];
                foreach ($arrayBusca as $key => $value) {
                    $buscaCidade[] = "name LIKE '%$value%'";
                    $buscaBairros[] = "name LIKE '%$value%'";
                    $buscaTipos[] = "name LIKE '%$value%'";
                }
                $query->whereRaw("
                    (cidade_id IN (SELECT id FROM cidades WHERE ". join(" OR ", $buscaCidade) .")) OR
                    (bairro_id IN (SELECT id FROM bairros WHERE ". join(" OR ", $buscaBairros) .")) OR
                    (tipo_id IN (SELECT id FROM tipos WHERE ". join(" OR ", $buscaTipos) .")) OR
                    codigo like '%".$request->busca."%'");
            }
        })
        ->with(['tipos','bairros','cidades'])
        ->orderBy('preco', $oderBy == 'vasc' ? 'ASC' : 'DESC')
        ->paginate($perPage);

    foreach ($imoveis as $key => $value) {
        $value->statusName = $value->getStatusName();
        $value->image = asset('storage/imovel/'.$value->image);
    }

     return response()->json($imoveis, 200);
   }

    public function show ($slugImovel) {
        $imovel = Imovel::where('slug', $slugImovel)->with(['tipos','bairros','cidades','imagens_extra'])->first();

        if(!$imovel){
            return response()->json('', 404);    
        }
        
        $imovel->statusName = $imovel->getStatusName();
        $imovel->image = asset('storage/imovel/'.$imovel->image);
        $imovel->banner = asset('storage/imovel/'.$imovel->banner);

        foreach ($imovel->imagens_extra as $key => $value) {
            $value->image = asset('storage/imovel/'.$value->image);
        }
        
        return response()->json($imovel, 200);
    }

   public function status (Request $request) {
       $imovel = Imovel::first();
       
       return response()->json($imovel->statusNames, 200);
   }
}
