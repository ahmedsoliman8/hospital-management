<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model  implements TranslatableContract
{
    use  Translatable;
    public $translatedAttributes=['name','address'];
    protected  $guarded=[];
    use HasFactory;
}
