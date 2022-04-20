<?php

use App\Http\Controllers\AssignTicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;

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
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['user','auth'])->group(function(){
    Route::resource('tickets', TicketController::class);
    Route::post('ticket/fetchMobile',[TicketController::class,'fetchMobile']);
    Route::get('report',[TicketController::class,'viewReport']);
    Route::post('/generateReport',[TicketController::class,'generateReport']);
    Route::resource('/users', UserController::class);
    
});

Route::middleware(['agent','auth'])->prefix('agent')->group(function(){
    Route::resource('/assign', AssignTicketController::class);
});