<?php

namespace App\Repository\DoctorDashboard;
use App\Interfaces\DoctorDashboard\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index()
    {
        $invoices = Invoice::where('doctor_id',  Auth::user()->id)->where('invoice_status',1)->get();
        return view('Dashboard.Doctor.invoices.index',compact('invoices'));
    }

    public function reviewInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
        return view('Dashboard.Doctor.invoices.review_invoices', compact('invoices'));
    }


    public function completedInvoices()

    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
        return view('Dashboard.Doctor.invoices.completed_invoices', compact('invoices'));
    }
}
