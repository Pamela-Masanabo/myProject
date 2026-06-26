<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\PatientController;
use App\Models\Visit;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
  
/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:ADMIN'])
->group(function () {
    Route::get('/admin/dashboard',
    [AdminController::class, 'index'])
    ->name('admin.dashboard');  
    
Route::get('/admin/register-staff',[AdminController::class,'create'])->name('staff.create');
Route::post('/admin/register-staff',[AdminController::class,'store'])->name('staff.store');
});

/*
|--------------------------------------------------------------------------
| Receptionist
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:RECEPTIONIST'])

    ->group(function () {

        Route::get('/reception/dashboard',[ReceptionController::class,'index'])->name('reception.dashboard');
        Route::post('/reception/verify/{visit}',[ReceptionController::class,'verify'])->name('visit.verify');   
});

/*
|--------------------------------------------------------------------------
| Screening Nurse
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:STAFF_NURSE'])

    ->group(function () {

        Route::get('/screening/dashboard',

            [ScreeningController::class,'index'])

            ->name('screening.dashboard');
});

/*
|--------------------------------------------------------------------------
| Professional Nurse
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:PROFESSIONAL_NURSE'])

    ->group(function () {

        Route::get('/consultation/dashboard',

            [ConsultationController::class,'index'])

            ->name('consultation.dashboard');
});
/*
|--------------------------------------------------------------------------
| Doctor
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:DOCTOR'])

    ->group(function () {

        Route::get('/doctor/dashboard',

            [DoctorController::class,'index'])

            ->name('doctor.dashboard');

});

/*
|--------------------------------------------------------------------------
| Visit
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/check-in',[VisitController::class,'create'])->name('visit.create');
    Route::post('/check-in',[VisitController::class,'store'])->name('visit.store');

});
/*
|--------------------------------------------------------------------------
| Patient
|--------------------------------------------------------------------------
*/
Route::get('/',[PatientController::class,'welcome'])->name('welcome');
Route::get('/patient/login',[PatientController::class,'showLogin'])->name('patient.login');
Route::post('/patient/login',[PatientController::class,'login'])->name('patient.login.store');
Route::get('/patient/register',[PatientController::class,'create'])->name('patient.register');
Route::post('/patient/register',[PatientController::class,'store'])->name('patient.store');

Route::get('/patient/dashboard',[PatientController::class,'dashboard'])->name('patient.dashboard');

require __DIR__.'/auth.php';
