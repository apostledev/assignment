<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membership = new Membership();
        $membership->user_id = User::first()->id;
        $membership->team_id = Team::first()->id;
        $membership->save();
    }
}
