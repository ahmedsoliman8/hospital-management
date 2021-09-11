<?php

namespace App\Http\Controllers\DoctorDashboard;

use App\Http\Controllers\Controller;
use App\Repository\DoctorDashboard\InvoiceRepository;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $invoice;

    public function __construct(InvoiceRepository $invoice)
    {
        $this->invoice = $invoice;
    }




    public function index()
    {
        return  $this->invoice->index();
    }

    public  function completedInvoices(){
        return  $this->invoice->completedInvoices();
    }

    public function reviewInvoices(){
        return  $this->invoice->reviewInvoices();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
