<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceTranslation extends Model
{

    protected $fillable = ['driver_name','notes'];
    public $timestamps = false;
    use HasFactory;
}
