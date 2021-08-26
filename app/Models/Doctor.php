<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable implements TranslatableContract
{

     use  Translatable;
    public $translatedAttributes=['name'];
    protected  $fillable=['email','email_verified_at','password','phone','status','section_id'];
  //s  protected  $guarded=[];
    use HasFactory,Notifiable;

    protected $remember_token = false;



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
        ];


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
