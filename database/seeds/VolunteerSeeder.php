<?php

use App\Office;
use App\Volunteer;
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
            'name' => VOLUNTEER_DRIVER,
            'phone' => '0998989898',
            'email' => trim(VOLUNTEER_DRIVER . '@gmail.com'),
            'office_id' => Office::where('name', OFFICE_ONE)->first()->id,
        ];
        $volunteer = Volunteer::create($data);
        $volunteerJob = VolunteerJob::where('name', JOB_DRIVER)->first()->id;
        $volunteer->volunteerJobs()->toggle([$volunteerJob]);

        $data = [
            'name' => VOLUNTEER_STORE_KEEPER,
            'phone' => '0998989891',
            'email' => trim(VOLUNTEER_STORE_KEEPER . '@gmail.com'),
            'office_id' => Office::where('name', OFFICE_ONE)->first()->id,
        ];
        $volunteerTwo = Volunteer::create($data);
        $volunteerJobTwo = VolunteerJob::where('name', JOB_STORE_KEEPER)->first()->id;
        $volunteerTwo->volunteerJobs()->toggle([$volunteerJobTwo]);

        $data = [
            'name' => VOLUNTEER_REPAIRER,
            'phone' => '0998989895',
            'email' => trim(VOLUNTEER_REPAIRER . '@gmail.com'),
            'office_id' => Office::where('name', OFFICE_ONE)->first()->id,
        ];
        $volunteerThree = Volunteer::create($data);
        $volunteerJobThree = VolunteerJob::where('name', JOB_REPAIRER)->first()->id;
        $volunteerThree->volunteerJobs()->toggle([$volunteerJobThree]);

        $data = [
            'name' => VOLUNTEER_DELIVER,
            'phone' => '0998989491',
            'email' => trim(VOLUNTEER_DELIVER . '@gmail.com'),
            'office_id' => Office::where('name', OFFICE_ONE)->first()->id,
        ];
        $volunteerFour = Volunteer::create($data);
        $volunteerJobFour = VolunteerJob::where('name', JOB_DELIVER)->first()->id;
        $volunteerFour->volunteerJobs()->toggle([$volunteerJobFour]);
    }
}
