<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 8/27/2021
 * Time: 3:00 PM
 */

namespace App\Repository\DoctorDashboard;


use App\Interfaces\DoctorDashboard\DiagnosisRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DiagnosisRepository implements  DiagnosisRepositoryInterface
{
    public function store($request)
    {
        try {
            DB::beginTransaction();
            $this->invoice_status($request->invoice_id,3);
            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();
            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $patient_records = Diagnostic::where('patient_id',$id)->get();
        return view('Dashboard.Doctor.invoices.patient_record',compact('patient_records'));
    }

    public function addReview($request)
    {

        try {
            DB::beginTransaction();
            $this->invoice_status($request->invoice_id,2);
            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->review_date = date('Y-m-d H:i:s');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function invoice_status($invoice_id,$id_status){
        $invoice_status = Invoice::findorFail($invoice_id);
        $invoice_status->update([
            'invoice_status'=>$id_status
        ]);
    }

}