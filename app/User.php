<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'group_id', 'current_event_id', 'email', 'username', 'password', 'image', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function listItems($paginate, $search = null)
    {
        if($search){
            $items = DB::table('users')
                            ->select('id','name','email','username')
                            ->where(function($query) use ($search){
                              $query->orWhere('id','like','%'.$search.'%')
                                    ->orWhere('name','like','%'.$search.'%')
                                    ->orWhere('email','like','%'.$search.'%')
                                    ->orWhere('username','like','%'.$search.'%');
                            })                        
                            ->where('type', 0)
                            ->orderBy('id','DESC')
                            ->paginate($paginate);
        }else{
            $items = DB::table('users')
                            ->select('id','name','email','username')
                            ->where('type', 0)
                            ->orderBy('id','DESC')
                            ->paginate($paginate);
        }

        return $items;
    }

    public function client()
    {
        return $this->hasOne('App\Client', 'user_id');
    }   

    /*
     * Get the group that the user belongs to
     */
    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
}
