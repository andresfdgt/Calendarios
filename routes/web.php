<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleAccountController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\UtilidadesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->away(env('MODULE_MASTER'));
})->name("login");
Route::get('/logout', [LoginController::class, 'logout'])->middleware(['auth'])->name('logout');
Route::group(['middleware' => ['auth', 'verified']], function () {
  Route::group(['middleware' => 'BaseDatosPrivada'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
    
    Route::prefix('calendarios')->group(function () {
      Route::get('/', [CalendarioController::class, 'index'])->name('calendarios')->middleware("ExistPermission:150");
      Route::get('/buscar', [CalendarioController::class, 'buscar'])->name('buscar')->middleware("ExistPermission:150");
      Route::get('/calendario', [CalendarioController::class, 'calendario'])->name('calendario')->middleware("ExistPermission:150");
      Route::get('/listado', [CalendarioController::class, 'listado'])->name('calendarios.listados')->middleware("ExistPermission:150");
      Route::get('/verCalendarios/{id}', [CalendarioController::class, 'verCalendarios'])->name('calendarios.verCalendarios')->middleware("ExistPermission:150");
      Route::put('/leido/{albaran_id}', [CalendarioController::class, 'actualizarLeido'])->name('calendarios.leido')->middleware("ExistPermission:150");
      Route::get('/editar/{id}', [CalendarioController::class, 'editar'])->name('calendarios.editar');
      Route::get('/tipos/{id}', [CalendarioController::class, 'tipos'])->name('calendarios.tipos');
      Route::get('/buscar_albaran/{clasificacion}/{tipo}/{numero}', [CalendarioController::class, 'buscarAlbaran'])->name('calendarios.buscar_albaran');
      Route::get('/buscar_albaran_existente/{id}', [CalendarioController::class, 'buscarAlbaranExistente'])->name('calendarios.buscar_albaran_existente');
      Route::post('/orden', [CalendarioController::class, 'orden'])->name('calendarios.orden');
      Route::get('/eventos/{id}/{calendario?}', [CalendarioController::class, 'eventos'])->name('calendarios.eventos')->middleware("ExistPermission:153");
      Route::get('/monitoreos/{id}', [CalendarioController::class, 'monitoreos'])->name('calendarios.monitoreos')->middleware("ExistPermission:153");
      Route::get('/imprimir/{id}', [CalendarioController::class, 'imprimirAlbaran'])->name('calendarios.imprimirAlbaran')->middleware("ExistPermission:157");
      Route::get('/{id}', [CalendarioController::class, 'verCalendario'])->name('calendarios.verCalendario')->middleware("ExistPermission:157");
      Route::post('/', [CalendarioController::class, 'store'])->name('calendarios.store');
      Route::put('/', [CalendarioController::class, 'update'])->name('calendarios.update');
      Route::post('/eventos', [CalendarioController::class, 'storeEventos'])->name('eventos.store')->middleware("ExistPermission:154");
      Route::put('/eventos', [CalendarioController::class, 'updateEventos'])->name('eventos.update');
      Route::put('/eventosDate', [CalendarioController::class, 'updateEventosDate'])->name('eventos.updateDate');
      Route::put('/', [CalendarioController::class, 'update'])->name('calendarios.update')->middleware("ExistPermission:155");
      Route::delete('/eventos/{id}', [CalendarioController::class, 'deleteEventos'])->name('eventos.delete')->middleware("ExistPermission:156");
      Route::delete('/{id}', [CalendarioController::class, 'delete'])->name('calendarios.delete');
    });

    Route::get('/usuarios/empresas', [UtilidadesController::class, 'empresas'])->name('usuarios.empresas');
    Route::put('/usuarios/empresas/{id}', [UtilidadesController::class, 'establecerEmpresa'])->name('usuarios.establecer.empresas');
  });
});
