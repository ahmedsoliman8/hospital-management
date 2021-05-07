<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $doctors= Doctor::factory()->count(10)->create();
       // $Appointments = Appointment::all()->random()->id;
        foreach ($doctors as $doctor){
            $doctor->doctorappointments()->attach(Appointment::all()->random(2)->pluck("id"));
        }
    }
}
