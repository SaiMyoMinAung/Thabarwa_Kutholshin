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
                'name' => JOB_DRIVER,
                'description' => JOB_DRIVER . ' Description'
            ],
            [
                'name' => JOB_STORE_KEEPER,
                'description' => JOB_STORE_KEEPER . ' Description'
            ],
            [
                'name' => JOB_REPAIRER,
                'description' => JOB_REPAIRER . ' Description'
            ],
            [
                'name' => JOB_DELIVER,
                'description' => JOB_DELIVER . ' Description'
            ],
        ];

        VolunteerJob::insert($data);
    }
}
