<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Competicoes extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'date', 'local',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public static function listItems($paginate, $search = null)
    {
        if ($search) {
            $items = DB::table('competicoes')
                ->select('id', 'name')
                ->where(function ($query) use ($search) {
                    $query->orWhere('id', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'ASC')
                ->paginate($paginate);
        } else {
            $items = DB::table('competicoes')
                ->select('id', 'name')
                ->orderBy('id', 'ASC')
                ->paginate($paginate);
        }

        return $items;
    }
}
