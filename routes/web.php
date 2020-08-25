<?php



Route::get('/', function () {
    return view('contenido/contenido');
});
//zona 1
//Route::get('/compuertas/ver_datos','CompuertaController@ver_datos');
Route::get('/compuertas','CompuertaController@index');
Route::put('/compuertas/actualizar','CompuertaController@update');
Route::get('/rios','RioController@index');
Route::get('/canales','CanalController@index');
Route::get('/chacras','ChacraController@index');

//zona 2
Route::get('/compuertas/2','CompuertaController@index2');
Route::put('/compuertas/2/actualizar','CompuertaController@update');
Route::get('/rios/2','RioController@index2');
Route::get('/canales/2','CanalController@index2');
Route::get('/chacras/2','ChacraController@index2');
//zona 3
Route::get('/compuertas/3','CompuertaController@index3');
Route::put('/compuertas/3/actualizar','CompuertaController@update');
Route::get('/rios/3','RioController@index3');
Route::get('/canales/3','CanalController@index3');
Route::get('/chacras/3','ChacraController@index3');


//Docente
Route::get('/docentes','DocenteController@index');
Route::post('/docentes/registrar','DocenteController@store');
Route::put('/docentes/actualizar','DocenteController@update');
Route::get('/docentes/selectDocente','DocenteController@selectDocente');
//estudiante
Route::get('/estudiantes','EstudianteController@index');
Route::post('/estudiantes/registrar','EstudianteController@store');
Route::put('/estudiantes/actualizar','EstudianteController@update');
Route::get('/estudiantes/selectEstudiante','EstudianteController@selectEstudiante');
//Curso
Route::get('/cursos','CursoController@index');
Route::post('/cursos/registrar','CursoController@store');
Route::put('/cursos/actualizar','CursoController@update');
Route::get('/cursos/selectCurso','CursoController@selectCurso');
//Docente_Curso
Route::get('/docentes_cursos','Docente_CursoController@index');
Route::post('/docentes_cursos/registrar','Docente_CursoController@store');
Route::put('/docentes_cursos/actualizar','Docente_CursoController@update');
Route::get('/docentes_cursos/selectDocenteCurso','Docente_CursoController@selectDocenteCurso');
//Sillabus
Route::get('/sillabus','SillabuController@index');
Route::post('/sillabus/registrar','SillabuController@store');
//carpetas
Route::get('/carpetas','CarpetaController@index');
Route::post('/carpetas/registrar','CarpetaController@store');





