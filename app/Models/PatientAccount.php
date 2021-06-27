<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;
    public $fillable= ['date','single_invoice_id','patient_id','debit','credit','payment_id'];
}
