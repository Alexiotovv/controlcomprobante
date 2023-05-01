<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalidacomprobantesController;
use App\Http\Controllers\ComprobantesController;

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
 Route::get('/comprobantes/create',[SalidacomprobantesController::class,'create'])->middleware(['auth'])->name('comprobantes.create');
//end Comprobantes


//Comprobantes
Route::get('/comprobantes/show/{nrocomp}/{nomemp}',[ComprobantesController::class,'show'])->middleware(['auth'])->name('comprobantes.show');
//End Comprobantes


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