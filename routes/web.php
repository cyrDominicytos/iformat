<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Room;
use App\Http\Controllers\Group;
use App\Http\Controllers\Learning;
use App\Http\Controllers\Planning;
use App\Http\Controllers\Assessment;
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
    Route::get('/listLearnings/close/{id}', [Learning::class, 'close'])->name('listLearnings.close');
    Route::post('/listLearnings/update', [Learning::class, 'update'])->name('listLearnings.update');
    Route::get('/listLearnings/delete/{id}', [Learning::class, 'destroy'])->name('listLearnings.delete');
    Route::post('/listLearnings/getLearning', [Learning::class, 'getLearning'])->name('listLearnings.getLearning');
   
    //Presence                                                                                  
    Route::get('/addPresence/{code?}', [Planning::class, 'presence'])->name('addPresence');
    Route::post('/listPresence/planning_list', [Planning::class, 'planning_list'])->name('listPresence.planning_list');
    Route::post('/listPresence/planning_details_list', [Planning::class, 'planning_details_list'])->name('listPresence.planning_details_list');
    Route::post('/listPresence/group_participant_list', [Planning::class, 'group_participant_list'])->name('listPresence.group_participant_list');
    Route::post('/listPresence/store', [Planning::class, 'presence_store'])->name('listPresence.store');
    Route::post('/listPresence/update', [Planning::class, 'presence_update'])->name('listPresence.update');
    Route::get('/listPresence', [Planning::class, 'listPresence'])->name('listPresence');
    Route::post('/listPresence/print', [Planning::class, 'presence_print'])->name('listPresence.print');
   
    //Certification                                                                                  
    Route::get('/addCertification/{code?}', [Planning::class, 'certify'])->name('addCertification');
    Route::post('/listCertification/learning_groups', [Planning::class, 'certif_learning_groups'])->name('listCertification.learning_groups');
    Route::post('/listCertification/certify_group_participant_list', [Planning::class, 'certify_group_participant_list'])->name('listCertification.certify_group_participant_list');
    Route::post('/listCertification/store', [Planning::class, 'certification_store'])->name('listCertification.store');

    //Session
    Route::get('/addPlanning/{code?}', [Planning::class, 'add'])->name('addPlanning');
    Route::get('/listPlannings', [Planning::class, 'list'])->name('listPlannings');
    Route::post('/listPlannings/store', [Planning::class, 'store'])->name('listPlannings.store');
    Route::get('/listPlannings/edit/{id}', [Planning::class, 'edit'])->name('listPlannings.edit');
    Route::post('/listPlannings/update', [Planning::class, 'update'])->name('listPlannings.update');
    Route::get('/listPlannings/delete/{id}', [Planning::class, 'destroy'])->name('listPlannings.delete');
    Route::post('/listPlannings/learning_time_slot', [Planning::class, 'learning_time_slot'])->name('listPlannings.learning_time_slot');
    Route::post('/listPlannings/learning_days', [Planning::class, 'learning_days'])->name('listPlannings.learning_days');
    Route::post('/listPlannings/learning_available_groupe', [Planning::class, 'learning_available_groupe'])->name('listPlannings.learning_available_groupe');
    Route::post('/listPlannings/learning_available_groupe2', [Planning::class, 'learning_available_groupe2'])->name('listPlannings.learning_available_groupe2');
    Route::get('/planningsView', [Planning::class, 'planningsView'])->name('planningsView');
    Route::post('/planningsView/get_events_plannings', [Planning::class, 'get_events_plannings'])->name('listPlannings.get_events_plannings');
   
    
    //Assessment
    Route::get('/addAssessment', [Assessment::class, 'add'])->name('addAssessment');
    Route::post('/listAssessment/store', [Assessment::class, 'store'])->name('listAssessment.store');
    Route::get('/getAssessments', [Planning::class, 'getAssessments'])->name('getAssessments');


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


    //PDF Controller
    Route::get('create-pdf-file', [PDFController::class, 'index']);
   
   
});
