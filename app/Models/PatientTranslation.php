<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PatientTranslation extends Model
{
    protected $fillable = ['name','address'];
    public $timestamps = false;
}
