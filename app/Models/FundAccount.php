<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;
    public $fillable= ['date','group_invoice_id','single_invoice_id','debit','credit','payment_id'];
}
