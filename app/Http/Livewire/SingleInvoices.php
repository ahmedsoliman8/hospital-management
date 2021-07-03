<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\SingleInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $InvoiceSaved,$InvoiceUpdated;
    public $show_table = true;
    public $tax_rate = 17;
    public $updateMode = false;
    public $price,$discount_value=0,$patient_id,$doctor_id,$section,$type,$service_id,$single_invoice_id;

    public function render()
    {
        $this->discount_value=is_numeric($this->discount_value)?$this->discount_value:0;
        return view('livewire.single_invoices.single-invoices', [
            'single_invoices'=> SingleInvoice::all(),
            'patients'=> Patient::all(),
            'doctors'=> Doctor::all(),
            'services'=> Service::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }

    public function show_form_add(){
        $this->show_table = false;
    }

    public function get_section()
    {
        $doctor = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section = $doctor->section->name;

    }

    public function get_price()
    {
        $this->price = Service::where('id', $this->service_id)->first()->price;
    }

    public function edit($id){

        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = SingleInvoice::findorfail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->service_id = $single_invoice->service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;


    }

    public function store(){

        // في حالة كانت الفاتورة نقدي
        if($this->type == 1){



            try{
                DB::beginTransaction();
                if($this->updateMode){
                    $single_invoices = SingleInvoice::findOrfail($this->single_invoice_id);
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $fund_accounts = FundAccount::where('single_invoice_id',$this->single_invoice_id)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->single_invoice_id = $single_invoices->id;
                    $fund_accounts->Debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $this->reset('price','discount_value','patient_id','doctor_id','section','type','service_id','tax_rate');
                    $this->InvoiceSaved =false;
                    $this->InvoiceUpdated=true;
                    $this->show_table =true;

                }else{

                    $single_invoices = new SingleInvoice();
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();
                    $fund_accounts = new FundAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->single_invoice_id = $single_invoices->id;
                    $fund_accounts->Debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $this->reset('price','discount_value','patient_id','doctor_id','section','type','service_id','tax_rate');
                    $this->InvoiceSaved =true;
                    $this->InvoiceUpdated=false;
                    $this->show_table =true;

                }
                DB::commit();

            }  catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }


        }else{

            try{
                DB::beginTransaction();
                if($this->updateMode){
                    $single_invoices = SingleInvoice::findOrfail($this->single_invoice_id);
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $patient_accounts = PatientAccount::where('single_invoice_id',$this->single_invoice_id)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->single_invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->Debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();

                    $this->reset('price','discount_value','patient_id','doctor_id','section','type','service_id','tax_rate');
                    $this->InvoiceSaved =false;
                    $this->InvoiceUpdated=true;
                    $this->show_table =true;

                }else{

                    $single_invoices = new SingleInvoice();
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section)->first()->section_id;
                    $single_invoices->service_id = $this->service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $patient_accounts = new PatientAccount();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->single_invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->Debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();

                    $this->reset('price','discount_value','patient_id','doctor_id','section','type','service_id','tax_rate');
                    $this->InvoiceSaved =true;
                    $this->InvoiceUpdated=false;
                    $this->show_table =true;

                }
                DB::commit();

            }  catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

        }


    }


    public function deleteModel($id){

        $this->single_invoice_id = $id;

    }

    public function print($id)
    {
        $single_invoice = SingleInvoice::findorfail($id);
        return Redirect::route('print_single_invoices',[
            'invoice_date' => $single_invoice->invoice_date,
            'doctor_id' => $single_invoice->doctor->name,
            'section_id' => $single_invoice->section->name,
            'service_id' => $single_invoice->service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);

    }

    public function destroy(){
        SingleInvoice::destroy($this->single_invoice_id);
        return redirect()->to('/single_invoices');
    }




}
