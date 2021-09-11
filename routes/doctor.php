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
        Route::get('completed_invoices', [DoctorDashboard\InvoiceController::class,'completedInvoices'])->name('completedInvoices');
        Route::get('review_invoices', [DoctorDashboard\InvoiceController::class,'reviewInvoices'])->name('reviewInvoices');
        Route::resource('invoices', DoctorDashboard\InvoiceController::class);
        //Diagnostics
        Route::post('add_review', [DoctorDashboard\DiagnosisController::class,'addReview'])->name('add_review');
        Route::resource('diagnosis', DoctorDashboard\DiagnosisController::class);
    });
    //#############################################################################

    require __DIR__.'/auth.php';

});

