<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nadador extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'equipe_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public static function listItems($paginate, $id = null, $search = null)
    {
        if ($search) {
            $items = DB::table('nadadors')
                ->select('id', 'name')
                ->whereRaw("equipe_id = $id")
                ->where(function ($query) use ($search) {
                    $query->orWhere('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'ASC')
                ->paginate($paginate);
        } else {
            $items = DB::table('nadadors')
                ->select('id', 'name')
                ->whereRaw("equipe_id = $id")
                ->orderBy('id', 'ASC')
                ->paginate($paginate);
        }

        return $items;
    }
}
