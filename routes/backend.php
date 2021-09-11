<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;


Route::get('/Dashboard_Admin',[Dashboard\DashboardController::class,'index']);

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
        Route::resource('sections',Dashboard\SectionController::class);
        //----------------------------------------------------------------------------
        //------------------------Doctor-----------------------------------------------------------------------------------
        Route::resource('doctors',Dashboard\DoctorController::class);
        Route::post('update_password', [Dashboard\DoctorController::class, 'update_password'])->name('update_password');
        Route::post('update_status', [Dashboard\DoctorController::class, 'update_status'])->name('update_status');
        //----------------------------------------------------------------------------------------------------------------

        //------------------------Service-----------------------------------------------------------------------------------
        Route::resource('service', Dashboard\SingleServiceController::class);

        //----------------------------------------------------------------------------------------------------------------

        //------------------------------------GroupServices---------------------------------------------------------------
        Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');
        //------------------------------------------------------------------------------------------------------------------



        //############################# insurance route ##########################################

        Route::resource('insurances', Dashboard\InsuranceController::class);

        //############################# end insurance route ######################################


        //############################# Ambulance route ##########################################

        Route::resource('ambulances', Dashboard\AmbulanceController::class);

        //############################# end insurance route ######################################


        //############################# Patient route ##########################################

        Route::resource('patients', Dashboard\PatientController::class);

        //############################# end insurance route ######################################



        //############################# single_invoices route ##########################################

        Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
        Route::view('print_single_invoices','livewire.single_invoices.print')->name('print_single_invoices');

        //############################# end single_invoices route ######################################







        //############################# Receipt route ##########################################

        Route::resource('receipts', Dashboard\ReceiptAccountController::class);

        //############################# end Receipt route ######################################


        //############################# Payment route ##########################################

      Route::resource('payments', Dashboard\PaymentAccountController::class);

        //############################# end Payment route ######################################



        //############################# group_invoices route ##########################################

        Route::view('group_invoices','livewire.group_invoices.index')->name('group_invoices');

        Route::view('group_print_single_invoices','livewire.group_invoices.print')->name('group_print_single_invoices');

        //############################# end single_invoices route ######################################




    });
    //-------------------------------------------------------------------------------


    require __DIR__.'/auth.php';

});

