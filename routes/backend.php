<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Livewire\CreateGroupServices;
use App\Http\Controllers\Dashboard\PatientController;

use App\Http\Controllers\Dashboard\ReceiptAccountController;

use App\Http\Controllers\Dashboard\PaymentAccountController;

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


        //############################# Patient route ##########################################

        Route::resource('patients', PatientController::class);

        //############################# end insurance route ######################################



        //############################# single_invoices route ##########################################

        Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
        Route::view('print_single_invoices','livewire.single_invoices.print')->name('print_single_invoices');

        //############################# end single_invoices route ######################################







        //############################# Receipt route ##########################################

        Route::resource('receipts', ReceiptAccountController::class);

        //############################# end Receipt route ######################################


        //############################# Payment route ##########################################

      Route::resource('payments', PaymentAccountController::class);

        //############################# end Payment route ######################################



    });
    //-------------------------------------------------------------------------------


    require __DIR__.'/auth.php';

});

