<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorDashboard;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::get('/dashboard/doctor', function () {
        return view('Dashboard.Doctor.index');
    })->middleware('auth:doctor')->name('dashboard.doctor');
    //##################### Dashboard Doctor ####################################
    Route::group( [ 'prefix' => 'doctor' , 'as'=>'doctor.', 'middleware' => ['auth:doctor']], function()
    {
        //invoices
        Route::resource('invoices', DoctorDashboard\InvoiceController::class);


    });
    //#############################################################################







    require __DIR__.'/auth.php';

});

