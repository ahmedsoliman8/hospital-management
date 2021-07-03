<?php


namespace App\Repository\Finance;
use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payments =  PaymentAccount::all();
        return view('Dashboard.payments.index',compact('payments'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('Dashboard.payments.add',compact('patients'));
    }

    public function store($request)
    {


        try {
            DB::beginTransaction();
            // store receipt_accounts
            $payment_accounts = new PaymentAccount();
            $payment_accounts->date =date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->credit;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();

            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->payment_id = $payment_accounts->id;
            $fund_accounts->credit = $request->credit;
            $fund_accounts->debit = 0.00;
            $fund_accounts->save();

            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_id = $payment_accounts->id;
            $patient_accounts->debit = $request->credit;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('payments.create');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $payment_accounts = PaymentAccount::findorfail($id);
        $patients = Patient::all();
        return view('Dashboard.payments.edit',compact('payment_accounts','patients'));
    }

    public function show($id)
    {
        $payment_account = PaymentAccount::findorfail($id);
        return view('Dashboard.payments.print',compact('payment_account'));
    }

    public function update($request)
    {


        try {
            DB::beginTransaction();
            // update receipt_accounts
            $payment_accounts = PaymentAccount::findorfail($request->id);
            $payment_accounts->date =date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->credit;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();

            // update fund_accounts
            $fund_accounts = FundAccount::where('payment_id',$payment_accounts->id)->first();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->payment_id = $payment_accounts->id;
            $fund_accounts->credit = $request->credit;
            $fund_accounts->debit = 0.00;
            $fund_accounts->save();

            // update patient_accounts
            $patient_accounts = PatientAccount::where('payment_id',$payment_accounts->id)->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_id = $payment_accounts->id;
            $patient_accounts->debit = $request->credit;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('payments.index');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            PaymentAccount ::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
