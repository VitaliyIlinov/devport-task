<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLinkController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function (Router $router) {
    return Redirect::route('user-links.index');
});

Route::prefix('user-links')->as('user-links.')->group(function (Router $router) {
    $router->get('/{user_url}', [UserLinkController::class, 'resolve'])
        ->where('user_url', '[A-Za-z0-9]{20}')
        ->name('resolve');

    Route::middleware('auth')->group(function (Router $router) {
        $router->get('/', [UserLinkController::class, 'index'])->name('index');
        $router->post('/', [UserLinkController::class, 'store'])->name('store');
        $router->get('{userLink}/deactivate', [UserLinkController::class, 'deactivate'])->name('deactivate');
        $router->get('{userLink}/activate', [UserLinkController::class, 'activate'])->withTrashed()->name('activate');
    });
});

Route::prefix('users')->as('users.')->group(function (Router $router) {
    $router->get('/logout', [UserController::class, 'logout'])->name('logout');
    $router->get('/create', [UserController::class, 'create'])->name('create');
    $router->post('/', [UserController::class, 'store'])->name('store');
});
