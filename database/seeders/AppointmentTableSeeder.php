<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->delete();
        for ($i=1;$i<=7;$i++){
            Appointment::create(
                [
                    'ar'=>[
                        'name'=>LANGUAGEDAYS['ar'][$i]
                        ],
                    'en'=>[
                        'name'=>LANGUAGEDAYS['en'][$i]
                        ]

                ]
            );
        }
    }
}
