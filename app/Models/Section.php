<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Section extends Model implements TranslatableContract
{
    use  Translatable;
    public $translatedAttributes=['name','description'];
    protected  $guarded=[];

    use HasFactory;

    public function  doctors(){
        return $this->hasMany(Doctor::class);
    }


}
