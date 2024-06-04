<?php

use App\Http\Controllers\SpecialityController;
use App\Models\Speciality;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetsltrController;
use App\Http\Controllers\CargaMasivaSltrController;              
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\ExcelServiceProvider;
use App\Http\Controllers\UserController;



Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);
/* Rutas de las especilalidades  */
Route::get('/especialidades', [App\Http\Controllers\SpecialityController::class, 'index']);
Route::get('/especialidades/create', [App\Http\Controllers\SpecialityController::class, 'create']);
Route::get('/especialidades/{speciality}/edit', [App\Http\Controllers\SpecialityController::class, 'edit']);
Route::post('/especialidades', [App\Http\Controllers\SpecialityController::class, 'sendData']);

Route::put('/especialidades/{speciality}', [App\Http\Controllers\SpecialityController::class, 'update']);
Route::delete('/especialidades/{speciality}', [App\Http\Controllers\SpecialityController::class, 'destroy']);
/* RUTAS MET-004 SLCB */
Route::get('/metslcb', [App\Http\Controllers\MetslcbController::class, 'index']);
Route::get('/metslcb/create', [App\Http\Controllers\MetslcbController::class, 'create']);
Route::get('/metslcb/{metslcb}/edit', [App\Http\Controllers\MetslcbController::class, 'edit']);
Route::post('/metslcb', [App\Http\Controllers\MetslcbController::class, 'sendData']);

Route::put('/metslcb/{metslcb}', [App\Http\Controllers\MetslcbController::class, 'update']);
Route::delete('/metslcb/{metslcb}', [App\Http\Controllers\MetslcbController::class, 'destroy']);
/* RUTAS MET-004 SLTR */
Route::get('/metsltr', [App\Http\Controllers\MetsltrController::class, 'index']);
Route::get('/metsltr/create', [App\Http\Controllers\MetsltrController::class, 'create']);
Route::get('/metsltr/{metsltr}/edit', [App\Http\Controllers\MetsltrController::class, 'edit']);
Route::post('/metsltr', [App\Http\Controllers\MetsltrController::class, 'sendData']);
/* cargar datos a SLTR */
Route::get('/carga-masiva', [CargaMasivaSltrController::class, 'mostrarFormularioCarga']);
Route::post('/metsltr/carga-masiva', 'App\Http\Controllers\CargaMasivaSltrController@cargarDatos')->name('carga-masiva');


Route::put('/metsltr/{metsltr}', [App\Http\Controllers\MetsltrController::class, 'update']);
Route::delete('/metsltr/{metsltr}', [App\Http\Controllers\MetsltrController::class, 'destroy']);

/* RUTAS MET-004 SLGM */
Route::get('/metslgm', [App\Http\Controllers\MetslgmController::class, 'index']);
Route::get('/metslgm/create', [App\Http\Controllers\MetslgmController::class, 'create']);
Route::get('/metslgm/{metslgm}/edit', [App\Http\Controllers\MetslgmController::class, 'edit']);
Route::post('/metslgm', [App\Http\Controllers\MetslgmController::class, 'sendData']);

Route::put('/metslgm/{metslgm}', [App\Http\Controllers\MetslgmController::class, 'update']);
Route::delete('/metslgm/{metslgm}', [App\Http\Controllers\MetslgmController::class, 'destroy']);

/* RUTAS MET-004 SLVR */
Route::get('/metslvr', [App\Http\Controllers\MetslvrController::class, 'index']);
Route::get('/metslvr/create', [App\Http\Controllers\MetslvrController::class, 'create']);
Route::get('/metslvr/{metslvr}/edit', [App\Http\Controllers\MetslvrController::class, 'edit']);
Route::post('/metslvr', [App\Http\Controllers\MetslvrController::class, 'sendData']);

Route::put('/metslvr/{metslvr}', [App\Http\Controllers\MetslvrController::class, 'update']);
Route::delete('/metslvr/{metslvr}', [App\Http\Controllers\MetslvrController::class, 'destroy']);

/* RUTAS MET-004 SLJO */
Route::get('/metsljo', [App\Http\Controllers\MetsljoController::class, 'index']);
Route::get('/metsljo/create', [App\Http\Controllers\MetsljoController::class, 'create']);
Route::get('/metsljo/{metsljo}/edit', [App\Http\Controllers\MetsljoController::class, 'edit']);
Route::post('/metsljo', [App\Http\Controllers\MetsljoController::class, 'sendData']);

Route::put('/metsljo/{metsljo}', [App\Http\Controllers\MetsljoController::class, 'update']);
Route::delete('/metsljo/{metsljo}', [App\Http\Controllers\MetsljoController::class, 'destroy']);

/* RUTAS MET-004 SLMG */
Route::get('/metslmg', [App\Http\Controllers\MetslmgController::class, 'index']);
Route::get('/metslmg/create', [App\Http\Controllers\MetslmgController::class, 'create']);
Route::get('/metslmg/{metslmg}/edit', [App\Http\Controllers\MetslmgController::class, 'edit']);
Route::post('/metslmg', [App\Http\Controllers\MetslmgController::class, 'sendData']);

Route::put('/metslmg/{metslmg}', [App\Http\Controllers\MetslmgController::class, 'update']);
Route::delete('/metslmg/{metslmg}', [App\Http\Controllers\MetslmgController::class, 'destroy']);

/* RUTAS DE LA PESTAÑA METAR */
Route::get('/metar',[App\Http\Controllers\MetarController::class, 'index']);
Route::get('/metar/create',[App\Http\Controllers\MetarController::class, 'create']);
Route::get('/metar/{metar}/edit',[App\Http\Controllers\MetarController::class, 'edit']);
Route::post('/metar',[App\Http\Controllers\MetarController::class, 'sendData']);

Route::put('/metar/{metar}',[App\Http\Controllers\MetarController::class, 'update']);
Route::delete('/metar/{metar}',[App\Http\Controllers\MetarController::class, 'destroy']);

/* busqueda avanzada */
Route::get('tblmetar', [App\Http\Controllers\MetarController::class, 'tabla']);


/* ruta para exportar a excel */ 
Route::get('/specialities/export', [App\Exports\SpecialitiesExport::class, 'exportExcel'])->name('specialities.export');

/* Crar usuarios */
Route::middleware(['auth'])->group(function () {

    /* USERS */
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('users.create');  // ¡Añade esta línea aquí!
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

});
