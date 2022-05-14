<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\Message\MessageController;
use Illuminate\Support\Facades\Route;

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
})->middleware(['auth'])->name('dashboard');

Route::get('/chats', [ChatController::class, 'index'])->middleware(['auth'])->name('chat.index');
Route::get('/chats/{chat}/enter', [ChatController::class, 'enter'])->middleware(['auth'])->name('chat.enter');
Route::post('/chats/{chat}/messages/send', [MessageController::class, 'send'])->middleware(['auth'])->name('chat.message.send');

require __DIR__.'/auth.php';
