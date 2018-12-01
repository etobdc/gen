<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'email',
        'name',
        'cpf',
        'birthdate',
        'phone',
        'secondary_phone',
        'zipcode',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'moip_id',
    ];

    protected $hidden = [
        'id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function available_orders()
    {
        return $this->hasMany('App\Order')
                ->where('available', 1)
                ->where('start', '>=', date('Y-m-d'))
                ->where('end', '<', date('Y-m-d'));
    }

    public static function list($paginate, $search = null)
    {
        if($search){
            $items = DB::table('clients')
                            ->select('id','name','email','cpf')
                            ->where(function($query) use ($search){
                              $query->orWhere('id','like','%'.$search.'%')
                                    ->orWhere('name','like','%'.$search.'%')
                                    ->orWhere('email','like','%'.$search.'%')
                                    ->orWhere('cpf','like','%'.$search.'%');
                            })                        
                            ->orderBy('id','DESC')
                            ->paginate($paginate);
        }else{
            $items = DB::table('clients')
                            ->select('id','name','email','cpf')
                            ->orderBy('id','DESC')
                            ->paginate($paginate);
        }

        return $items;
    }
}
