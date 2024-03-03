<?php

use App\Livewire\Item;
use App\Livewire\Brand;
use App\Livewire\Model;
use App\Livewire\ProductCrud;
use App\Livewire\UnlimitedManueAndSub;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
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


Route::get('/', function () {
    return view('welcome');
});
Route::get('/students/export-to-excel', [StudentController::class, 'exportToExcel'])->name('students.exportToExcel');
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/todo', ProductCrud::class)->name('todo');
    Route::get('/manues', UnlimitedManueAndSub::class)->name('manues');
    Route::get('/brands', Brand::class)->name('brands');
    Route::get('/models', Model::class)->name('models');
    Route::get('/items', Item::class)->name('items');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::get('/chats', 'App\Http\Controllers\PusherController@index')->name('chats');
    Route::post('/broadcast', 'App\Http\Controllers\PusherController@broadcast');
    Route::post('/receive', 'App\Http\Controllers\PusherController@receive');
});

