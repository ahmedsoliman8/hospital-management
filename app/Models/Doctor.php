<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Doctor extends Model implements TranslatableContract
{

    use  Translatable;
    public $translatedAttributes=['name'];
  //  protected  $fillable=['email','email_verified_at','password','phone','price','name','appointments'];
    protected  $guarded=[];
    use HasFactory;





    /**
     * Get the doctor's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Get the doctor's image.
     */
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function doctorappointments()
    {
        return $this->belongsToMany(Appointment::class,'appointment_doctor','doctor_id','appointment_id');
    }
}
