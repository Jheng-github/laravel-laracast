<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Models\User;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//前綴設定成v1 因為是api.php裡面 所以url會像這樣 api/v1/user 然後使用 UserController 來當控制器
Route::group(['prefix' => 'v1'], function(){
    Route::apiResource('user', UserController::class);
});

// Route::get('/', function () {

//     return User::all();
//     //return view('index');
// });
