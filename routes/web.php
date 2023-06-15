<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalidacomprobantesController;
use App\Http\Controllers\ComprobantesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DevolucioncomprobantesController;


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
    return view('usuarios.login');
});



Route::get('/login',function(){
    return view('usuarios.login');
})->name('login')->middleware('guest');

Route::get('/home',function(){
    return view('plantillas.home');
})->middleware('auth')->name('home');

//Comprobantes
Route::get('/comprobantes/show/{nrocomp}/{nomemp}',[ComprobantesController::class,'show'])->middleware(['auth'])->name('comprobantes.show');
Route::get('/comprobantes/create/',[ComprobantesController::class,'create'])->middleware(['auth'])->name('comprobantes.create');
Route::post('/comprobantes/store/',[ComprobantesController::class,'store'])->middleware(['auth'])->name('comprobantes.store');
Route::post('/comprobantes/update/',[ComprobantesController::class,'update'])->middleware(['auth'])->name('comprobantes.update');
Route::get('/comprobantes/edit/{id}',[ComprobantesController::class,'edit'])->middleware(['auth'])->name('comprobantes.edit');

Route::get('/comprobantes/index/',[ComprobantesController::class,'index'])->middleware(['auth'])->name('comprobantes.index');
Route::get('/comprobantes/filtrar/{num}/{nom}/{est}/{paq}',[ComprobantesController::class,'filtrar'])->middleware(['auth'])->name('comprobantes.filtrar');
//end Comprobantes

//SalidaComprobantes
Route::get('/salidacomprobantes/create',[SalidacomprobantesController::class,'create'])->middleware(['auth'])->name('salidacomprobantes.create');
Route::post('/salidacomprobantes/store',[SalidacomprobantesController::class,'store'])->middleware(['auth'])->name('salidacomprobantes.store');
Route::post('/salidacomprobantes/update',[SalidacomprobantesController::class,'update'])->middleware(['auth'])->name('salidacomprobantes.update');
Route::get('/salidacomprobantes/index',[SalidacomprobantesController::class,'index'])->middleware(['auth'])->name('salidacomprobantes.index');
Route::get('/salidacomprobantes/show/{nrocargo}/{nrocomp}/{nrooficio}/{cliente}',[SalidacomprobantesController::class,'show'])->middleware(['auth'])->name('salidacomprobantes.show');
Route::get('/salidacomprobantes/edit/{id}',[SalidacomprobantesController::class,'edit'])->middleware(['auth'])->name('salidacomprobantes.edit');
//EndSalidaComprobantes


//Devolucion Comprobantes
Route::post('/devolucioncomprobantes/store',[DevolucioncomprobantesController::class,'store'])->middleware(['auth'])->name('devolucioncomprobantes.store');
//End Devolucion Comprobantes


//Clientes
Route::get('/clientes/create/',[ClientesController::class,'create'])->middleware(['auth'])->name('clientes.create');
Route::get('/clientes/index',[ClientesController::class,'index'])->middleware(['auth'])->name('clientes.index');
Route::get('/clientes/listar',[ClientesController::class,'listar'])->middleware(['auth'])->name('clientes.listar');
Route::get('/clientes/show/',[ClientesController::class,'show'])->middleware(['auth'])->name('clientes.show');
Route::post('/clientes/store/',[ClientesController::class,'store'])->middleware(['auth'])->name('clientes.store');
Route::post('/clientes/update',[ClientesController::class,'update'])->middleware(['auth'])->name('clientes.update');
//End Clientes



//Usuarios
Route::get('/usuarios/index', [UserController::class,'index'])->middleware(['auth'])->name('usuarios.index');
Route::get('/usuarios/edit/{id}', [UserController::class,'edit'])->middleware(['auth'])->name('usuarios.edit');
Route::post('/usuarios/update', [UserController::class,'update'])->middleware(['auth'])->name('usuarios.update');
Route::get('/usuarios/create', [UserController::class,'create'])->middleware(['auth'])->name('usuarios.create');
Route::post('/usuarios/store', [UserController::class,'store'])->middleware(['auth'])->name('usuarios.store');

Route::get("/verificanombre/{name}",[UserController::class,'verificanombre'])->middleware(['auth'])->name('verificanombre');
Route::get("/verificaemail/{email}",[UserController::class,'verificaemail'])->middleware(['auth'])->name('verificaemail');
Route::post("/ActualizaContrasena",[UserController::class, "ActualizaContrasena"])->middleware(['auth'])->name('Actualiza.Contrasena');

Route::post("/login",[LoginController::class, 'login']);
Route::put('/login', [LoginController::class, 'logout']);