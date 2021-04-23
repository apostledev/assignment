<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Team::factory(10)->create();
    }
}
