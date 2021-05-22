<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Group extends Model  implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name','notes'];
    public $fillable= ['total_before_discount','discount_value','total_after_discount','tax_rate','total_with_tax'];
    public function service_group()
    {
        return $this->belongsToMany(Service::class,'service_group')->withPivot('quantity');
    }
}
