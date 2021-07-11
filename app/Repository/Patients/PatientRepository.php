<?php

namespace App\Repository\Patients;

use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Models\SingleInvoice;
use Illuminate\Support\Facades\Hash;


class PatientRepository implements PatientRepositoryInterface
{
    public function index()
    {
        $patients = Patient::all();
        return view('Dashboard.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('Dashboard.patients.create');
    }

    public function store($request)
    {
       //return $request->all();
        try {

            $requestData=$request->except(['_token','_method']);
            // return $request->input() ;
            $requestData['password'] = Hash::make($request->Phone);
            Patient::create($requestData);
            session()->flash('add');
            return redirect()->route('patients.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $patient = Patient::findorfail($id);
        return view('Dashboard.patients.edit', compact('patient'));
    }

    public function update($request)
    {
        $requestData=$request->except(['_token','_method','id']);
        $requestData['password'] = Hash::make($request->Phone);
        $patient = Patient::findOrFail($request->id);
        $patient->update($requestData);
        session()->flash('edit');
        return redirect('patients');
    }

    public function destroy($request)
    {
       /// return $request->all();
        Patient::destroy($request->id);
        session()->flash('delete');
        return redirect('patients');
    }


    public function Show($id)
    {
        $patient = Patient::findorfail($id);
        $invoices = SingleInvoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $patient_accounts = PatientAccount::where('patient_id', $id)
         //   ->orWhereNotNull('receipt_id')
            //->orWhereNotNull('Payment_id')
          //  ->where('patient_id', $id)
            ->get();
        return view('Dashboard.patients.show', compact('patient', 'invoices', 'receipt_accounts', 'patient_accounts'));
    }
}
