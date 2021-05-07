<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;

Route::get('/Dashboard_Admin',[DashboardController::class,'index']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


    //##################### Dashboard User ####################################
    Route::get('/dashboard/user', function () {
        return view('Dashboard.User.index');
    })->middleware(['auth'])->name('dashboard.user');
    //##########################################################################
    //##################### Dashboard Admin ####################################
    Route::get('/dashboard/admin', function () {
        return view('Dashboard.Admin.index');
    })->middleware(['auth:admin'])->name('dashboard.admin');

    //#############################################################################





    Route::middleware(['auth:admin'])->group(function (){
        //------------------------Section--------------------------------------------
        Route::resource('sections',SectionController::class);
        //----------------------------------------------------------------------------
        //------------------------Doctor-----------------------------------------------------------------------------------
        Route::resource('doctors',DoctorController::class);
        Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
        Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');
        //----------------------------------------------------------------------------------------------------------------
    });
    //-------------------------------------------------------------------------------


    require __DIR__.'/auth.php';

});

