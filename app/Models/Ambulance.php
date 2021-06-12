<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ambulance extends Model
{
    use  Translatable;
    public $translatedAttributes=['driver_name','notes'];
    protected  $guarded=[];
    use HasFactory;
}
