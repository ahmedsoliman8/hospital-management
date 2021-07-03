<?php


namespace App\Repository\Finance;


use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{

    public function index()
    {

        $receipts =  ReceiptAccount::all();
        return view('Dashboard.receipts.index',compact('receipts'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('Dashboard.receipts.add',compact('patients'));
    }

    public function store($request)
    {


        try{
            DB::beginTransaction();
            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->amount = $request->debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->debit;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('receipts.create');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $receipt_accounts = ReceiptAccount::findorfail($id);
        $patients = Patient::all();
        return view('Dashboard.receipts.edit',compact('receipt_accounts','patients'));
    }

    public function show($id)
    {
        $receipt_account = ReceiptAccount::findorfail($id);
        return view('Dashboard.receipts.print',compact('receipt_account'));
    }

    public function update($request)
    {

        try{
            DB::beginTransaction();
            // store receipt_accounts
            $receipt_accounts = ReceiptAccount::findorfail($request->id);
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->amount = $request->debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = FundAccount::where('receipt_id',$request->id)->first();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = PatientAccount::where('receipt_id',$request->id)->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->debit;
            $patient_accounts->save();


            DB::commit();
            session()->flash('edit');
            return redirect()->route('receipts.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            ReceiptAccount ::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
