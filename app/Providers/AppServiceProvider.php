<?php

namespace App\Providers;

use App\Configs;
use App\Imovel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        $types = Imovel::listTypes();

        View::share([
            'data' => $data,
            'headerTypes' => $types,
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
