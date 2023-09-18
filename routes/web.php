<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SimulationController;

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

// Landing Page
Route::get('/', function () {
    return view('landing-page');
});

// Under Development Page
Route::get('/under-development', function () {
    return view('additional.under-dev');
});

// Test URL
Route::get('/cek', function () {
    return view('exam/instruction-daerah');
});

// Auth
Route::controller(AuthController::class)->group(function(){
    Route::get('/sign-in', 'signin')->name('login.show');
    Route::get('/sign-up', 'signup')->name('register.show');
    Route::post('/sign-in', 'login')->name('login');
    Route::post('/sign-up', 'register')->name('register');
    Route::post('/sign-out', 'logout')->name('logout');
    Route::get('/input-email', 'input_email')->name('input-email');
});

// User
Route::controller(UserController::class)->group(function(){
    Route::get('/user-dashboard', 'dashboard')->name('user.dashboard');
    Route::get('/user-history', 'history')->name('user.history');
});

// Admin
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin', 'dashboard')->name('admin.dashboard');
    Route::get('/admin/user/page/{page}', 'user_index')->name('admin.user.index');

    // Multiple Choice Routes
    Route::get('/admin/multiple-choice/pusat/{page}', 'mp_index_pusat')->name('admin.mp.index.pusat');
    Route::get('/admin/multiple-choice/daerah/{page}', 'mp_index_daerah')->name('admin.mp.index.daerah');
    Route::get('/admin/multiple-choice/show/{mp_id}', 'mp_show')->name('admin.mp.show');
    Route::get('/admin/multiple-choice/create', 'mp_create')->name('admin.mp.create');
    Route::post('/admin/multiple-choice/create', 'mp_store')->name('admin.mp.store');
    Route::get('/admin/multiple-choice/edit/{mp_id}', 'mp_edit')->name('admin.mp.edit');
    Route::post('/admin/multiple-choice/edit/{mp_id}', 'mp_update')->name('admin.mp.update');
    Route::post('/admin/multiple-choice/delete/{mp_id}', 'mp_delete')->name('admin.mp.delete');

    // Case Study Routes
    Route::get('/admin/essay/pusat/{page}', 'ey_index_pusat')->name('admin.ey.index.pusat');
    Route::get('/admin/essay/daerah/{page}', 'ey_index_daerah')->name('admin.ey.index.daerah');
    Route::get('/admin/essay/show/{ey_id}', 'ey_show')->name('admin.ey.show');
    Route::get('/admin/essay/create', 'ey_create')->name('admin.ey.create');
    Route::post('/admin/essay/create', 'ey_store')->name('admin.ey.store');
    Route::get('/admin/essay/edit/{ey_id}', 'ey_edit')->name('admin.ey.edit');
    Route::post('/admin/essay/edit/{ey_id}', 'ey_update')->name('admin.ey.update');
    Route::post('/admin/essay/delete/{ey_id}', 'ey_delete')->name('admin.ey.delete');

    // Case Study Routes
    Route::get('/admin/case-study/pusat/{page}', 'cs_index_pusat')->name('admin.cs.index.pusat');
    Route::get('/admin/case-study/daerah/{page}', 'cs_index_daerah')->name('admin.cs.index.daerah');
    Route::get('/admin/case-study/show/{cs_id}', 'cs_show')->name('admin.cs.show');
    Route::get('/admin/case-study/create', 'cs_create')->name('admin.cs.create');
    Route::post('/admin/case-study/create', 'cs_store')->name('admin.cs.store');
    Route::get('/admin/case-study/edit/{cs_id}', 'cs_edit')->name('admin.cs.edit');
    Route::post('/admin/case-study/edit/{cs_id}', 'cs_update')->name('admin.cs.update');
    Route::post('/admin/case-study/delete/{cs_id}', 'cs_delete')->name('admin.cs.delete');
});

// Simulation
Route::controller(SimulationController::class)->group(function(){
    Route::get('/type-select', 'type_select')->name('exam.type');
    Route::get('/instruction/pusat', 'instruction_pusat')->name('exam.instruction.pusat');
    Route::get('/instruction/daerah', 'instruction_daerah')->name('exam.instruction.daerah');
    
    // Start Exam and Get Session ID
    Route::post('/start-exam', 'start_exam')->name('exam.start');

    // Navigate Through Pages with $page
    Route::get('/cgaa-simulation-exam/page/{page}', 'exam_data')->name('exam.progress');
    Route::post('/cgaa-simulation-exam/save', 'save_or_submit')->name('exam.saveorsubmit');
    Route::post('/cgaa-simulation-exam/page', 'exam_save')->name('exam.save');
    
    // Exam Ended, Get Results and Explanation
    Route::post('/end-simulation', 'exam_submit')->name('exam.submit');
    Route::get('/exam-result/{session_id}', 'exam_result')->name('exam.result');
    Route::get('/exam-explanation/{session_id}/page/{page}', 'exam_explanation')->name('exam.explanation');
});