<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
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



// Authentication routes
Route::post('/edite-profile', [UserController::class, 'editProfile']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('forgot', [ResetPasswordController::class, 'forgot']);
Route::put('reset/{token}', [ResetPasswordController::class, 'reset'])->name('reset.password.post');

// Routes that require authentication
Route::group(['middleware' => ['auth']], function () {

    Route::get('livres', [LivreController::class,'index'])->name('livres.index');

    // Routes for moderators and super-admins
    Route::middleware(['role:moderator|super-admin'])->group(function () {
        Route::post('livres', [LivreController::class,'store'])->name('livres.store');
        Route::get('livres/{id}',[LivreController::class,'show'])->name('livres.show');
        Route::put('livres/{id}',[LivreController::class,'update'])->name('livres.update');
        Route::delete('livres/{id}',[LivreController::class,'destroy'])->name('livres.destroy');
    });

    // Routes for super-admins only
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('genres', [GenreController::class,'index'])->name('genres.index');
        Route::post('genres', [GenreController::class,'store'])->name('genres.store');
        Route::put('genres/{id}', [GenreController::class,'update'])->name('genres.update');
        Route::delete('genres/{id}', [GenreController::class,'destroy'])->name('genres.destroy');

        Route::get('given-moderator-role/{id}', [RoleController::class,'givenModeratorRole'])->name('given-moderator-role.givenModeratorRole');
        Route::post('given-admin-role/{id}', [RoleController::class,'givenAdminRole'])->name('given-admin-role.givenAdminRole');
        Route::post('given-user-role/{id}', [RoleController::class,'givenUserRole'])->name('given-user-role.givenUserRole');
        Route::post('getPermission', [RoleController::class,'getPermissions'])->name('given-user-role.getPermissions');
    });
});
