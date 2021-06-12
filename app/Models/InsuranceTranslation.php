<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InsuranceTranslation extends Model
{
    protected $fillable = ['name','notes'];
    public $timestamps = false;
}
