<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('VerifyApiIntegration')->namespace('Api')->group(function () {
    Route::get('imoveis', 'ImovelController@index');
    Route::get('imoveis/status', 'ImovelController@status');
    Route::get('imoveis/{imovel}', 'ImovelController@show');
    
    Route::get('blogs', 'BlogsController@index');
    Route::get('blogs/{blog}', 'BlogsController@show');

    Route::get('tipos', 'TiposController@index');
    Route::get('cidades', 'CidadesController@index');
    Route::get('slides', 'SlidesController@index');
    Route::get('depoimentos', 'DepoimentosController@index');
    Route::get('pages', 'PagesController@index');
    Route::get('configs', 'ConfigsController@index');
    
    Route::post('email/news', 'EmailsController@news');
    Route::post('email/contact', 'EmailsController@contact');
    Route::post('email/more_info_imovel', 'EmailsController@more_info_imovel');
    Route::post('email/interested_imovel', 'EmailsController@interested_imovel');
});