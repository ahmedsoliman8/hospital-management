<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Livewire\CreateGroupServices;

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

        //------------------------Service-----------------------------------------------------------------------------------
        Route::resource('service', SingleServiceController::class);

        //----------------------------------------------------------------------------------------------------------------

        //------------------------------------GroupServices---------------------------------------------------------------
        Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');
        //------------------------------------------------------------------------------------------------------------------



        //############################# insurance route ##########################################

        Route::resource('insurances', InsuranceController::class);

        //############################# end insurance route ######################################


        //############################# Ambulance route ##########################################

        Route::resource('ambulances', AmbulanceController::class);

        //############################# end insurance route ######################################



    });
    //-------------------------------------------------------------------------------


    require __DIR__.'/auth.php';

});

