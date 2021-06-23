<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptAccount extends Model
{
    use HasFactory;

    public $fillable= ['date','patient_id','debit','description'];


    public function patients()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
