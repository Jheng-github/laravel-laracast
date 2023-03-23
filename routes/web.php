<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     $tasks = ['1','2','3'];

//     return view('home',['tasks'=>$tasks]);
// });

// Route::get('register', [RegisterController::class, 'create']);
// Route::post('register', [RegisterController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::post('logout',[SessionController::class,'destory'])->middleware('auth');
Route::get('login',[SessionController::class,'create'])->middleware('guest');
Route::post('login',[SessionController::class,'store'])->middleware('guest');





Route::get('/', function () {

  //  return User::all();
    return view('index');
});



Route::get('/test', function () {
    $tasks = ['1','2','3'];

        return view('home',['tasks'=>$tasks]);
});