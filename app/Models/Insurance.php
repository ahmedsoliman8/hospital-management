<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insurance extends Model  implements TranslatableContract
{
    use  Translatable;
    public $translatedAttributes=['name','notes'];
    protected  $guarded=[];
    use HasFactory;
}
