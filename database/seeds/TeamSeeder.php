<?php

use App\Team;
use App\Center;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = new Team();
        $team->name = TEAM_ONE;
        $team->is_available = true;
        $team->center_id = Center::where('name', CENTER_ONE)->first()->id;
        $team->phone = '09779745015';
        $team->email = 'teamone@gmail.com';
        $team->save();

        $team = new Team();
        $team->name = TEAM_TWO;
        $team->is_available = true;
        $team->center_id = Center::where('name', CENTER_ONE)->first()->id;
        $team->phone = '09779745015';
        $team->email = 'teamtwo@gmail.com';
        $team->save();

        $team = new Team();
        $team->name = TEAM_THREE;
        $team->is_available = true;
        $team->center_id = Center::where('name', CENTER_TWO)->first()->id;
        $team->phone = '09779745015';
        $team->email = 'teamthree@gmail.com';
        $team->save();

        $team = new Team();
        $team->name = TEAM_FOUR;
        $team->is_available = true;
        $team->center_id = Center::where('name', CENTER_TWO)->first()->id;
        $team->phone = '09779745015';
        $team->email = 'teamfour@gmail.com';
        $team->save();
    }
}