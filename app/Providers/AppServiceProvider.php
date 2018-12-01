<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

use Auth;
use App\Configs;
use App\Contact;
use App\Imovel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255); //Increase string length

        $data = Configs::all()[0];
        $data->telefone_formated = str_replace('(', '', $data->telefone);
        $data->telefone_formated = str_replace(') ', '', $data->telefone_formated);
        $data->telefone_formated = str_replace('-', '', $data->telefone_formated);
        $data->telefone_2_formated = str_replace('(', '', $data->telefone_2);
        $data->telefone_2_formated = str_replace(') ', '', $data->telefone_2_formated);
        $data->telefone_2_formated = str_replace('-', '', $data->telefone_2_formated);
        $data->telefone_3_formated = str_replace('(', '', $data->telefone_3);
        $data->telefone_3_formated = str_replace(') ', '', $data->telefone_3_formated);
        $data->telefone_3_formated = str_replace('-', '', $data->telefone_3_formated);
        
        $realtorsAll = Contact::listRealtors();
        foreach ($realtorsAll as $realtor) {
            $realtor->telefone_format = str_replace('(', '', $realtor->telefone);
            $realtor->telefone_format = str_replace(') ', '', $realtor->telefone_format);
            $realtor->telefone_format = str_replace('-', '', $realtor->telefone_format);
        }

        $types = Imovel::listTypes();

        View::share([
            'data' => $data,
            'realtorsAll' => $realtorsAll,
            'headerTypes' => $types
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
