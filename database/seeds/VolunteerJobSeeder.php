<?php

use App\VolunteerJob;
use Illuminate\Database\Seeder;

class VolunteerJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => JOB_ONE,
                'description' => JOB_ONE . ' Description'
            ],
            [
                'name' => JOB_TWO,
                'description' => JOB_TWO . ' Description'
            ],
        ];

        VolunteerJob::insert($data);
    }
}
