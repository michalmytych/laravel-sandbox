<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\Message\MessageController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth'])
    ->name('dashboard');

Route::prefix('chats')->as('chat.')->middleware(['auth'])->group(function() {
    Route::prefix('messages')->as('message.')->group(function() {
        Route::post('{chat}/messages/send', [MessageController::class, 'send'])->name('send');
    });

    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::get('{chat}/enter', [ChatController::class, 'enter'])->name('enter');
});

require __DIR__.'/auth.php';
