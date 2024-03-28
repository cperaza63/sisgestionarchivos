<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', function () { return view('admin'); });

Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create')->middleware('auth');
Route::post('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware('auth');

Route::get('/registro', [App\Http\Controllers\UsuarioController::class, 'registro'])->name('admin.index');
Route::post('/registro', [App\Http\Controllers\UsuarioController::class, 'registro_create'])->name('registro');

Route::get('/admin/mi_unidad', [App\Http\Controllers\CarpetaController::class, 'index'])->name('mi_unidad.index')->middleware('auth');
Route::post('/admin/mi_unidad', [App\Http\Controllers\CarpetaController::class, 'store'])->name('mi_unidad.store')->middleware('auth');
Route::put('/admin/mi_unidad', [App\Http\Controllers\CarpetaController::class, 'update'])->name('mi_unidad.update')->middleware('auth');

Route::put('/admin/mi_unidad/carpeta', [App\Http\Controllers\CarpetaController::class, 'update_subcarpeta'])->name('mi_unidad.carpeta.update_subcarpeta')->middleware('auth');
Route::post('/admin/mi_unidad/carpeta/crear_subcarpeta', [App\Http\Controllers\CarpetaController::class, 'crear_subcarpeta'])->name('mi_unidad.carpeta.crear_subcarpeta')->middleware('auth');
Route::get('/admin/mi_unidad/carpeta/{id}', [App\Http\Controllers\CarpetaController::class, 'show'])->name('mi_unidad.carpeta')->middleware('auth');


Route::put('/admin/mi_unidad/color', [App\Http\Controllers\CarpetaController::class, 'update_color'])->name('mi_unidad.update_color')->middleware('auth');
Route::put('/admin/mi_unidad/color', [App\Http\Controllers\CarpetaController::class, 'update_subcarpeta_color'])->name('mi_unidad.carpeta.update_subcarpeta_color')->middleware('auth');

// rRutas para archivos
Route::post('/admin/mi_unidad/carpeta/upload', [App\Http\Controllers\ArchivoController::class, 'upload'])->name('mi_unidad.archivo.upload')->middleware('auth');
Route::delete('/admin/mi_unidad/carpeta', [App\Http\Controllers\ArchivoController::class, 'eliminar_archivo'])
->name('mi_unidad.archivo.eliminar_archivo')
->middleware('auth');
// Ruta para cambiar el estado de un archivo de forma Privada a Publia
Route::get('/admin/mi_unidad/carpeta', [App\Http\Controllers\ArchivoController::class, 'cambiar_de_privado_a_publico'])->name('mi_unidad.archivo.cambiar.privado.publico')->middleware('auth');

// RUTA PARA MOSTRAR ARCHIVOS PRIVADOS
Route::get('/storage/{carpeta}/{archivo}', function($carpeta, $archivo){
    if( Auth::check() ){
        $path = storage_path('app' . DIRECTORY_SEPARATOR . $carpeta . DIRECTORY_SEPARATOR . $archivo);
        return response()->file($path);
    }else{
        abort(403, 'No tiene permiso para acceder a este archivo');
    }
})->name('mostrar.archivos.privados');
