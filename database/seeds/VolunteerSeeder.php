<?php

use App\Office;
use App\Volunteer;
use App\StateRegion;
use App\VolunteerJob;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => VOLUNTEER_ONE,
            'phone' => '0998989898',
            'email' => trim(VOLUNTEER_ONE . '@gmail.com'),
            'password' => bcrypt('password'),
            'state_region_id' => StateRegion::where('name', STATE_REGION_ONE)->first()->id,
            'office_id' => Office::where('name', OFFICE_ONE)->first()->id,
        ];

        $volunteer = Volunteer::create($data);
        $volunteerJob = VolunteerJob::where('name', JOB_ONE)->first()->id;
        $volunteer->volunteerJobs()->toggle([$volunteerJob]);

        $data = [
            'name' => VOLUNTEER_TWO,
            'phone' => '0998989891',
            'email' => trim(VOLUNTEER_TWO . '@gmail.com'),
            'password' => bcrypt('password'),
            'state_region_id' => StateRegion::where('name', STATE_REGION_TWO)->first()->id,
            'office_id' => Office::where('name', OFFICE_TWO)->first()->id,
        ];

        $volunteerTwo = Volunteer::create($data);
        $volunteerJobTwo = VolunteerJob::where('name', JOB_TWO)->first()->id;
        $volunteerTwo->volunteerJobs()->toggle([$volunteerJobTwo]);
    }
}
