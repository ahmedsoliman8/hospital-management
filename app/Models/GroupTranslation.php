<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTranslation extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['name','notes'];
    public $timestamps = false;
}
