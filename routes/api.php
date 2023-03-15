<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forget-password', 'forgotPassword');
    Route::post('reset-password', 'reset');



});

Route::group(['controller' => GenreController::class], function (){
    Route::get('genres', 'index');
    Route::post('genres',   'store');
    Route::get('genres/{id}',  'show');
    Route::put('genres/{id}', 'update');
    Route::delete('genres/{id}', 'destroy');
});
Route::group(['controller' => UserController::class], function (){
    Route::get('edit-profile', 'index');
    Route::post('edit-profile',   'editProfile');

});


Route::post('sendPasswordResetLink', [ResetPasswordController::class, 'sendEmail']);


/*Route::controller(GenreController::class)->group(function (){
    Route::get('genres', 'index');
    Route::post('genres',   'store');
    Route::get('genres/{id}',  'show');
    Route::put('genres/{id}', 'update');
    Route::delete('genres/{id}', 'destroy');
});*/
/*
Route::get('/genres', [GenreController::class, 'index']);
Route::post('/genres-store', [GenreController::class, 'store']);
Route::get('/genres/{id}', [GenreController::class, 'show']);
Route::put('/genres/{id}', [GenreController::class, 'update']);
Route::delete('/genres/{id}', [GenreController::class, 'destroy']);*/


