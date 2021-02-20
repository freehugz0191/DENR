<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');

Route::get('/applicants', [App\Http\Controllers\ApplicantController::class, 'index'])->name('applicants');
Route::post('/add_applicants', [App\Http\Controllers\ApplicantController::class, 'store'])->name('add_applicants');
Route::get('/edit_applicants/{id}', [App\Http\Controllers\ApplicantController::class, 'edit'])->name('edit_applicants');
Route::get('/show_applicants/{id}', [App\Http\Controllers\ApplicantController::class, 'show'])->name('show_applicants');
Route::patch('/update_applicants/{id}', [App\Http\Controllers\ApplicantController::class, 'update'])->name('update_applicants');
Route::delete('/delete_applicants/{id}', [App\Http\Controllers\ApplicantController::class, 'destroy'])->name('delete_applicants');

Route::get('/CDStransactions', [App\Http\Controllers\CDSController::class, 'index'])->name('CDStransactions');
Route::post('/CDSadd_transactions', [App\Http\Controllers\CDSController::class, 'store'])->name('add_transactions');
Route::get('/CDSedit_transactions/{id}', [App\Http\Controllers\CDSController::class, 'edit'])->name('edit_transactions');
Route::get('/CDSshow_transactions/{id}', [App\Http\Controllers\CDSController::class, 'show'])->name('show_transactions');
Route::patch('/CDSupdate_transactions/{id}', [App\Http\Controllers\CDSController::class, 'update'])->name('update_transactions');
Route::delete('/CDSdelete_transactions/{id}', [App\Http\Controllers\CDSController::class, 'destroy'])->name('delete_transactions');

Route::get('/users_table', [App\Http\Controllers\UsersController::class, 'index'])->name('users_table');
Route::get('/edit_users/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('editUsers');
Route::patch('/update_users/{id}', [App\Http\Controllers\UsersController::class, 'update'])->name('update_users');
Route::delete('/delete_users/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('delete_users');

Route::get('/EMStransactions', [App\Http\Controllers\EMSController::class, 'index'])->name('CDStransactions');
Route::post('/EMSadd_transactions', [App\Http\Controllers\EMSController::class, 'store'])->name('add_transactions');
Route::get('/EMSedit_transactions/{id}', [App\Http\Controllers\EMSController::class, 'edit'])->name('edit_transactions');
Route::get('/EMSshow_transactions/{id}', [App\Http\Controllers\EMSController::class, 'show'])->name('show_transactions');
Route::patch('/EMSupdate_transactions/{id}', [App\Http\Controllers\EMSController::class, 'update'])->name('update_transactions');
Route::delete('/EMSdelete_transactions/{id}', [App\Http\Controllers\EMSController::class, 'destroy'])->name('delete_transactions');

Route::get('/RPStransactions', [App\Http\Controllers\RPSController::class, 'index'])->name('CDStransactions');
Route::post('/RPSadd_transactions', [App\Http\Controllers\RPSController::class, 'store'])->name('add_transactions');
Route::get('/RPSedit_transactions/{id}', [App\Http\Controllers\RPSController::class, 'edit'])->name('edit_transactions');
Route::get('/RPSshow_transactions/{id}', [App\Http\Controllers\RPSController::class, 'show'])->name('show_transactions');
Route::patch('/RPSupdate_transactions/{id}', [App\Http\Controllers\RPSController::class, 'update'])->name('update_transactions');
Route::delete('/RPSdelete_transactions/{id}', [App\Http\Controllers\RPSController::class, 'destroy'])->name('delete_transactions');

Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');


Route::get('/show_payment/{id}', [App\Http\Controllers\PaymentController::class, 'show'])->name('show_payment');
Route::post('/store_dynamicPay', [App\Http\Controllers\DynamicPayController::class, 'store_dynamicPay'])->name('store_dynamicPay');
Route::get('/totalPay/{id}', [App\Http\Controllers\DynamicPayController::class, 'totalPay'])->name('totalPay');


Route::get('/receiveDocs', [App\Http\Controllers\ReceiveDocsController::class, 'index'])->name('receiveDocs');
Route::post('/add_receiveDocs', [App\Http\Controllers\ReceiveDocsController::class, 'store_receive'])->name('add_receiveDocs');
Route::get('/show_receiveDocs/{id}', [App\Http\Controllers\ReceiveDocsController::class, 'show'])->name('show_receiveDocs');
Route::get('/edit_receiveDocs/{id}', [App\Http\Controllers\ReceiveDocsController::class, 'edit'])->name('edit_receiveDocs');
Route::patch('/update_receiveDocs/{id}', [App\Http\Controllers\ReceiveDocsController::class, 'update'])->name('update_receiveDocs');
Route::get('/update_dept/{id}', [App\Http\Controllers\ReceiveDocsController::class, 'update_dept'])->name('update_dept');
Route::get('/accept_receiveDocs/{id}', [App\Http\Controllers\ReceiveDocsController::class, 'update_status'])->name('accept_receiveDocs');
Route::get('/live_search.action', [App\Http\Controllers\ReceiveDocsController::class, 'action'])->name('live_search.action');

Route::post('/add_doctype', [App\Http\Controllers\DocumentController::class, 'store'])->name('add_doctype');
Route::get('/show_subDocs/{id}', [App\Http\Controllers\ReceiveDocsController::class, 'show_subDocs'])->name('show_subDocs');

Route::get('/reports', [App\Http\Controllers\ReportsController::class, 'index'])->name('reports');

Route::get('/releaseDocs', [App\Http\Controllers\ReleaseDocsController::class, 'index'])->name('releaseDocs');
Route::patch('/update_relDoc', [App\Http\Controllers\ReleaseDocsController::class, 'update_relDoc'])->name('update_relDoc');
Route::post('/add_DocTemplate', [App\Http\Controllers\ReleaseDocsController::class, 'store_template'])->name('add_DocTemplate');
Route::post('/add_requestDocs', [App\Http\Controllers\ReleaseDocsController::class, 'store_release'])->name('add_requestDocs');
Route::get('/show_requestDocs/{id}', [App\Http\Controllers\ReleaseDocsController::class, 'show'])->name('show_requestDocs');
Route::get('/accept_releaseDocs/{id}', [App\Http\Controllers\ReleaseDocsController::class, 'update_status'])->name('accept_releaseDocs');

Route::get('/appointments', [App\Http\Controllers\AppointmentsController::class, 'index'])->name('appointments');
Route::post('/add_appointments', [App\Http\Controllers\AppointmentsController::class, 'store'])->name('add_appointments');
Route::get('/edit_appointments/{id}', [App\Http\Controllers\AppointmentsController::class, 'edit'])->name('edit_appointments');
Route::patch('/update_appointments/{id}', [App\Http\Controllers\AppointmentsController::class, 'update'])->name('update_appointments');
Route::patch('/approveAppointment', [App\Http\Controllers\AppointmentsController::class, 'approveAppointment'])->name('approveAppointment');
Route::get('/showPendingAppointments', [App\Http\Controllers\AppointmentsController::class, 'showPendingAppointments'])->name('showPendingAppointments');

Route::get('/utilities', [App\Http\Controllers\UtilityController::class, 'index'])->name('utilities');
Route::post('/add_trandesc', [App\Http\Controllers\UtilityController::class, 'store_trandesc'])->name('add_trandesc');
Route::post('/add_docdesc', [App\Http\Controllers\UtilityController::class, 'store_docdesc'])->name('add_docdesc');
Route::post('/add_statusdesc', [App\Http\Controllers\UtilityController::class, 'store_statusdesc'])->name('add_statusdesc');
Route::post('/store_permitTemp', [App\Http\Controllers\UtilityController::class, 'store_permitTemp'])->name('store_permitTemp');
Route::patch('/edit_trandesc', [App\Http\Controllers\UtilityController::class, 'edit_trandesc'])->name('edit_trandesc');
Route::patch('/edit_docdesc', [App\Http\Controllers\UtilityController::class, 'edit_docdesc'])->name('edit_docdesc');
Route::patch('/edit_statusdesc', [App\Http\Controllers\UtilityController::class, 'edit_statusdesc'])->name('edit_statusdesc');
Route::patch('/edit_permitTemp', [App\Http\Controllers\UtilityController::class, 'edit_permitTemp'])->name('edit_permitTemp');
Route::delete('/delete_trandesc/{id}', [App\Http\Controllers\UtilityController::class, 'delete_trandesc'])->name('delete_trandesc');
Route::delete('/delete_docdesc/{id}', [App\Http\Controllers\UtilityController::class, 'delete_docdesc'])->name('delete_docdesc');
Route::delete('/delete_statusdesc/{id}', [App\Http\Controllers\UtilityController::class, 'delete_statusdesc'])->name('delete_statusdesc');
Route::delete('/delete_permitDoc/{id}', [App\Http\Controllers\UtilityController::class, 'delete_permitDoc'])->name('delete_permitDoc');

Route::get('/sample', [App\Http\Controllers\SampleController::class, 'index'])->name('sample');
Route::post('/add_sample', [App\Http\Controllers\SampleController::class, 'store'])->name('add_sample');
Route::get('/showsample/{id}', [App\Http\Controllers\SampleController::class, 'show'])->name('showsample');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::patch('/edit_profile', [App\Http\Controllers\ProfileController::class, 'update_picture'])->name('edit_profile');

Route::get('/guides', [App\Http\Controllers\GuideController::class, 'index'])->name('guides');
Route::patch('/edit_guide/{id}', [App\Http\Controllers\GuideController::class, 'edit_guide'])->name('edit_guide');
Route::get('/show_guide/{id}', [App\Http\Controllers\GuideController::class, 'show_guide'])->name('show_guide');

Route::get('/markAsReadReq{id}', function ($id) {
    DB::table('notifications')->where('id',$id)->update(['read_at'=>Carbon::now()]);
    return redirect('/releaseDocs');
});


Route::get('/markAsRead{id}', function ($id) {
    DB::table('notifications')->where('id',$id)->update(['read_at'=>Carbon::now()]);
    return redirect('/receiveDocs');
});

Route::get('/printReceipt/{id}', [App\Http\Controllers\PaymentController::class, 'printPay'])->name('printReceipt');

Route::patch('/approveTran/{id}', [App\Http\Controllers\TransactionController::class, 'approveTran'])->name('approveTran');
Route::patch('/rejectTran/{id}', [App\Http\Controllers\TransactionController::class, 'rejectTran'])->name('rejectTran');
