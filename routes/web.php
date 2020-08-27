<?php



Route::get('/', function () {
    return view('contenido/contenido');
});
//zona 1
//Route::get('/compuertas/ver_datos','CompuertaController@ver_datos');
Route::get('/compuertas','CompuertaController@index');
Route::put('/compuertas/actualizar','CompuertaController@update');
Route::get('/rios','RioController@index');
Route::put('/rios/actualizar','RioController@update');
Route::get('/canales','CanalController@index');
Route::put('/canales/actualizar','CanalController@update');
Route::get('/chacras','ChacraController@index');
Route::put('/chacras/actualizar','ChacraController@update');

//zona 2
Route::get('/compuertas/2','CompuertaController@index2');
Route::get('/rios/2','RioController@index2');
Route::get('/canales/2','CanalController@index2');
Route::get('/chacras/2','ChacraController@index2');
//zona 3
Route::get('/compuertas/3','CompuertaController@index3');
Route::get('/rios/3','RioController@index3');
Route::get('/canales/3','CanalController@index3');
Route::get('/chacras/3','ChacraController@index3');







