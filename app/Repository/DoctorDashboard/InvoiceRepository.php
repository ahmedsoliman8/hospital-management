<?php

namespace App\Repository\DoctorDashboard;
use App\Interfaces\DoctorDashboard\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index()
    {
        $invoices = Invoice::where('doctor_id',  Auth::user()->id)->get();
        return view('Dashboard.Doctor.invoices.index',compact('invoices'));
    }
}
