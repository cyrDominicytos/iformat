<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Room;
use App\Http\Controllers\Group;
use App\Http\Controllers\Learning;
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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'dashboard'])->name('home');
Route::get('/addParticipant', [HomeController::class, 'addParticipant'])->name('addParticipant');
Route::middleware(['auth'])->group(function () {
    Route::get('/addParticipant/{id?}', [HomeController::class, 'addParticipant'])->name('addParticipant');
    Route::get('/addSponsor/{id?}', [HomeController::class, 'addSponsor'])->name('addSponsor');
    Route::get('/addTeacher/{id?}', [HomeController::class, 'addTeacher'])->name('addTeacher');
    Route::get('/addAdmin/{id?}', [HomeController::class, 'addAdmin'])->name('addAdmin');
    Route::get('/users_list/{role}', [HomeController::class, 'users_list'])->where('role', '[1-5]+')->name('users_list');
    Route::get('/users_update/{role}/{id}', [HomeController::class, 'users_update'])->where('role', '[1-5]+')->name('users_update');
    Route::post('/user_edit', [HomeController::class, 'edit_user'])->name('user.edit');
    Route::get('/user/delete/{id}', [HomeController::class, 'destroy'])->name('user.delete');

    //Learning
    Route::get('/addLearning', [Learning::class, 'add'])->name('addLearning');
    Route::get('/listLearnings', [Learning::class, 'list'])->name('listLearnings');
    Route::post('/listLearnings/store', [Learning::class, 'store'])->name('listLearnings.store');
    Route::get('/listLearnings/edit/{id}', [Learning::class, 'edit'])->name('listLearnings.edit');
    Route::post('/listLearnings/update', [Learning::class, 'update'])->name('listLearnings.update');
    Route::get('/listLearnings/delete/{id}', [Learning::class, 'destroy'])->name('listLearnings.delete');
   
    //classrooms
    Route::get('/addRoom', [Room::class, 'add'])->name('addRoom');
    Route::get('/listRooms', [Room::class, 'list'])->name('listRooms');
    Route::post('/rooms/store', [Room::class, 'store'])->name('rooms.store');
    Route::post('/rooms/edit', [Room::class, 'edit'])->name('rooms.edit');
    Route::get('/rooms/delete/{id}', [Room::class, 'destroy'])->name('rooms.delete');

    //Groups
    Route::get('/addGroup', [Group::class, 'add'])->name('addGroup');
    Route::get('/listGroups', [Group::class, 'list'])->name('listGroups');
    Route::post('/groups/store', [Group::class, 'store'])->name('groups.store');
    Route::get('/groups/update/{id}', [Group::class, 'update'])->name('groups.update');
    Route::post('/groups/edit', [Group::class, 'edit'])->name('groups.edit');
    Route::get('/group/delete/{id}', [Group::class, 'destroy'])->name('group.delete');
   
});
