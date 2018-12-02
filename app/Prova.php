<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prova extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'competicao_id', 'prova', 'masculino', 'feminino',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public static function listItems($paginate, $id = null, $search = null)
    {
        if ($search) {
            $items = DB::table('provas')
                ->select('id', 'name')
                ->whereRaw("competicao_id = $id")
                ->where(function ($query) use ($search) {
                    $query->orWhere('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'ASC')
                ->paginate($paginate);
        } else {
            $items = DB::table('provas')
                ->select('id', 'name')
                ->whereRaw("competicao_id = $id")
                ->orderBy('id', 'ASC')
                ->paginate($paginate);
        }

        return $items;
    }
}
